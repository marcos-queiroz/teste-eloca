<template>
    <base-template>

        <div class="card">
            <div class="card-header">
                <h1>Clientes</h1>
            </div>

            <div class="card-body">
                <div class="d-grid justify-content-md-end mb-3">
                    <router-link to="/cliente/nova" class="btn btn-primary">
                        Novo
                    </router-link>
                </div>

                <div class="table table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Empresa</th>
                                <th>Nome/Razão social</th>
                                <th>Tipo</th>
                                <th>CPF/CNPJ</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in clientes" :key="cliente.recnum">
                                <td>{{ cliente.codigo }}</td>
                                <td>{{ cliente.empresa.razao_social }}</td>
                                <td>{{ cliente.razao_social }}</td>
                                <td>{{ cliente.tipo }}</td>
                                <td>{{ cliente.cpf_cnpj }}</td>
                                <td class="text-center">
                                    <router-link :to="'/cliente/editar/' + cliente.codigo" class="btn btn-sm btn-warning mx-1">
                                        Editar
                                    </router-link>
                                    <button @click="confirmDelete(cliente.codigo)" class="btn btn-sm btn-danger mx-1">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </base-template>
</template>

<script>
import BaseTemplate from './template/BaseTemplate.vue';

export default {
    components: {
        BaseTemplate
    },

    name: 'ClienteList',

    data() {
        return {
            clientes: [],
        };
    },

    mounted() {
        fetch('/api/cliente')
            .then(response => response.json())
            .then(data => {
                this.clientes = data;
            });
    },

    methods: {
        confirmDelete(codigo) {
            if (confirm('Tem certeza que deseja excluir este cliente?')) {
                fetch(`/api/cliente/${codigo}`, {
                    method: 'DELETE',
                })
                    .then(() => {
                        this.clientes = this.clientes.filter(cliente => cliente.codigo !== codigo);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    }

}
</script>
