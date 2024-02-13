<template>
    <base-template>

        <div class="card">
            <div class="card-header">
                <h1>Empresas</h1>
            </div>

            <div class="card-body">
                <div class="d-grid justify-content-md-end mb-3">
                    <router-link to="/empresa/nova" class="btn btn-primary">
                        Novo
                    </router-link>
                </div>

                <div class="table table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Empresa</th>
                                <th>Sigla</th>
                                <th>Razão social</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="empresa in empresas" :key="empresa.recnum">
                                <td>{{ empresa.codigo }}</td>
                                <td>{{ empresa.empresa }}</td>
                                <td>{{ empresa.sigla }}</td>
                                <td>{{ empresa.razao_social }}</td>
                                <td class="text-center">
                                    <router-link :to="'/empresa/editar/' + empresa.codigo" class="btn btn-sm btn-warning mx-1">
                                        Editar
                                    </router-link>
                                    <button @click="confirmDelete(empresa.codigo)" class="btn btn-sm btn-danger mx-1">
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

    name: 'EmpresaList',

    data() {
        return {
            empresas: [],
        };
    },

    mounted() {
        fetch('/api/empresa')
            .then(response => response.json())
            .then(data => {
                this.empresas = data;
            });
    },

    methods: {
        confirmDelete(codigo) {
            if (confirm('Tem certeza que deseja excluir esta empresa?')) {
                fetch(`/api/empresa/${codigo}`, {
                    method: 'DELETE',
                })
                    .then(() => {
                        this.empresas = this.empresas.filter(empresa => empresa.codigo !== codigo);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    }

}
</script>
