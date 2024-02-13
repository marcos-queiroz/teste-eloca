<h1 align="center">
  🔭 Teste Eloca
</h1>

<p align="center">
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-descrição">Descrição</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-requisitos">Requisitos</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-utilização">Utilização</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-inicialização-completa">Inicialização completa</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-host">Host</a>
</p>

## 📌 Projeto

Esse projeto é um sistema desenvolvido como teste técnico.

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 8.2](https://php.net/)
- [Composer](https://getcomposer.org)
- [Laravel](https://laravel.com/)
- [VueJS](https://vuejs.org/)
- [Docker](https://docker.com)

## 📌 Requisitos

Para executar esse teste de maneira rápida e sem complicações é necessário ter o Docker instalado e configurado.

## Utilização

> Obs.: No Windows de preferencia em utilizar o WSL.

Clone o projeto em um diretório com o comando:

```bash
git clone https://github.com/marcos-queiroz/teste-eloca.git
```

Acesse o diretório com o comando:

```bash
cd teste-eloca
```

Após clonar o projeto em um diretório, de permissão para o script com o comando:

```bash
chmod +x start-container.sh
```

## Inicialização completa

Para inicializar o projeto com uma base de dados do zero e todas as suas dependências utilize o comando:

```bash
./start-container.sh
```

## Host

Após os containers serem carregados, basta acessar o endereço no [http://eloca.localhost/](http://eloca.localhost/) navegador

## Api

Foi disponibilizada 2 endpoints da API REST para consumir basta utilizar os verbos HTTP nos endereços:

- `/api/empresa`
- `/api/cliente`

----
### Por fim é isso

:bowtie:
