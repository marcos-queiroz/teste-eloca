#!/bin/bash
set -e

# Captura o tempo de início
start_time=$(date +%s)

# Copia o .env
cp .env.example .env

# Carregar variáveis de ambiente do arquivo .env
if [ -f .env ]; then
    export $(cat .env | grep -v '^#' | awk '/=/ {print $1}')
else
    printf "Arquivo .env não encontrado"
    exit 1
fi

# Variáveis
BACKUP_PATH="./docker/restore"
DATABASE_CONTAINER="${COMPOSE_PROJECT_NAME}-database"
WEB_SERVER_CONTAINER="${COMPOSE_PROJECT_NAME}-webserver"
max_attempts=5
attempt_num=1

#!/bin/bash

# Nome de domínio e endereço IP a serem adicionados
DOMAIN="eloca.localhost"
IP="127.0.0.1"

# Verifica se a entrada já existe
if grep -q "$DOMAIN" /etc/hosts; then
    echo "A entrada para $DOMAIN já existe."
else
    # Adicionando a entrada no arquivo /etc/hosts
    echo "$IP $DOMAIN" | sudo tee -a /etc/hosts > /dev/null

    if [ $? -eq 0 ]; then
        echo "A entrada para $DOMAIN foi adicionada com sucesso ao /etc/hosts."
    else
        echo "Falha ao adicionar a entrada para $DOMAIN no /etc/hosts."
    fi
fi

# Inicia containers
printf "🚀 Construindo e iniciando os containers...\n"
docker compose up -d --build

# Espera até que o MySQL esteja pronto
until docker exec $DATABASE_CONTAINER mysql -u$DB_USERNAME -p$DB_PASSWORD -e ";" 2>/dev/null; do
    sleep 5
    attempt_num=$(($attempt_num + 1))
    if [ $attempt_num -gt $max_attempts ]; then
        printf "Não foi possível conectar ao banco de dados após $max_attempts tentativas.\n"
        exit 1
    fi
    printf "Tentando conectar ao banco de dados MySQL ($attempt_num/$max_attempts)...\n"
done

# Cria banco de dados se necessário
printf "📖 Criando o banco de dados '$DB_DATABASE'...\n"
docker exec -i $DATABASE_CONTAINER mysql -u$DB_USERNAME -p$DB_PASSWORD -e "CREATE DATABASE IF NOT EXISTS \`$DB_DATABASE\`;"

# Ajusta permissões dos diretórios
printf "🛠️  Ajustando permissões dos diretórios...\n"
find storage -type d ! -name '.gitignore' -exec docker exec -it $WEB_SERVER_CONTAINER chown www-data:www-data {} \;
find storage -type d ! -name '.gitignore' -exec docker exec -it $WEB_SERVER_CONTAINER chmod 775 {} \;
find storage -type f ! -name '.gitignore' -exec docker exec -it $WEB_SERVER_CONTAINER chown www-data:www-data {} \;
find storage -type f ! -name '.gitignore' -exec docker exec -it $WEB_SERVER_CONTAINER chmod 664 {} \;
find bootstrap/cache -type d -exec docker exec -it $WEB_SERVER_CONTAINER chown www-data:www-data {} \;
find bootstrap/cache -type d -exec docker exec -it $WEB_SERVER_CONTAINER chmod 775 {} \;
find bootstrap/cache -type f -exec docker exec -it $WEB_SERVER_CONTAINER chown www-data:www-data {} \;
find bootstrap/cache -type f -exec docker exec -it $WEB_SERVER_CONTAINER chmod 664 {} \;

# Instala dependências do Composer
printf "📈 Instalando dependências do Composer...\n"
docker exec -it $WEB_SERVER_CONTAINER composer install --no-interaction --optimize-autoloader

# Executa migrações do Laravel
printf "📝 Executando migrações do Laravel...\n"
docker exec -it $WEB_SERVER_CONTAINER php artisan migrate

# Executar seeders do Laravel
printf "📝 Executando seeders do Laravel...\n"
docker exec -it $WEB_SERVER_CONTAINER php artisan db:seed

# Cria link simbólico para storage
printf "🖇️  Criando link simbólico para o diretório de storage...\n"
docker exec -it $WEB_SERVER_CONTAINER php artisan storage:link

# Gera chave de aplicação
printf "🧹 Gerando chave de aplicação Laravel e limpando caches...\n"
docker exec -it $WEB_SERVER_CONTAINER php artisan key:generate

printf "🖥️  Containers iniciados e configurados com sucesso!\n"
end_time=$(date +%s)
elapsed_time=$(($end_time - $start_time))
printf "⏱️  Tempo total de execução: $elapsed_time segundos.\n"
printf "🖖 Agora tudo pronto para um bom trabalho. 😀\n"
