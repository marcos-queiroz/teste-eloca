<template>
    <base-template>
        <div class="container py-3">
            <h1 class="mb-4">
                Bem-vindo
            </h1>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ empresasCount }}
                            </h2>
                            <p class="card-text">
                                Empresas Cadastradas
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ clientesCount }}
                            </h2>
                            <p class="card-text">
                                Clientes Cadastrados
                            </p>
                        </div>
                    </div>
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
    data() {
        return {
            empresasCount: 0,
            clientesCount: 0
        };
    },
    mounted() {
        this.fetchEmpresasCount();
        this.fetchClientesCount();
    },
    methods: {
        fetchEmpresasCount() {
            fetch('/api/empresa/count')
                .then(response => response.json())
                .then(data => {
                    this.empresasCount = data.count;
                });
        },

        fetchClientesCount() {
            fetch('/api/cliente/count')
                .then(response => response.json())
                .then(data => {
                    this.clientesCount = data.count;
                });
        }
    }
}
</script>
