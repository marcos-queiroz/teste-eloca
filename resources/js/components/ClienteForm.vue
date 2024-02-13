<template>
    <base-template>
        <div class="card">
            <form @submit.prevent="submitForm">
                <div class="card-header">
                    <h2>
                        {{ cliente.recnum ? 'Editar' : 'Cadastrar' }} Cliente
                    </h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div v-if="!cliente.recnum" class="col-md-2 form-group">
                            <label for="codigo" class="form-label">
                                Código
                            </label>
                            <input type="text" class="form-control" id="codigo" v-model="cliente.codigo">
                            <div v-if="formErrors.codigo" class="text-danger">
                                {{ formErrors.codigo[0] }}
                            </div>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="empresa" class="form-label">
                                Empresa
                            </label>
                            <select id="empresa" class="form-select" v-model="cliente.empresa">
                                <option v-for="empresa in empresas" :key="empresa.codigo" :value="empresa.codigo">
                                    {{ empresa.sigla }} - {{ empresa.razao_social }}
                                </option>
                            </select>
                            <div v-if="formErrors.empresa" class="text-danger">
                                {{ formErrors.empresa[0] }}
                            </div>
                        </div>

                        <div class="form-group" :class="cliente.recnum ? 'col-md-4' : 'col-md-6'">
                            <label for="razao_social" class="form-label">
                                Nome/Razão social
                            </label>
                            <input type="text" class="form-control" id="razao_social" v-model="cliente.razao_social">
                            <div v-if="formErrors.razao_social" class="text-danger">
                                {{ formErrors.razao_social[0] }}
                            </div>
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="tipo" class="form-label">
                                tipo
                            </label>
                            <select id="tipo" class="form-select" v-model="cliente.tipo">
                                <option value="PF">Pessoa Física (PF)</option>
                                <option value="PJ">Pessoa Jurídica (PJ)</option>
                            </select>
                            <div v-if="formErrors.tipo" class="text-danger">
                                {{ formErrors.tipo[0] }}
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="cpf_cnpj" class="form-label">
                                CPF/CNPJ
                            </label>
                            <input type="text" class="form-control" id="cpf_cnpj" v-model="cliente.cpf_cnpj">
                            <div v-if="formErrors.cpf_cnpj" class="text-danger">
                                {{ formErrors.cpf_cnpj[0] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <router-link to="/cliente" class="btn btn-secondary">
                            Voltar
                        </router-link>
                        <button type="submit" class="btn btn-success">
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
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
            cliente: {},
            empresas: [],
            formErrors: {}
        };
    },

    async mounted() {
        if (this.$route.params.codigo) {
            const response = await fetch(`/api/cliente/${this.$route.params.codigo}`);
            const data = await response.json();
            this.cliente = data;
        }

        this.getListEmpresas();
    },

    methods: {
        async getListEmpresas() {
            const responseEmpresas = await fetch('/api/empresa');
            const dataEmpresas = await responseEmpresas.json();
            this.empresas = dataEmpresas;
        },

        submitForm() {
            const method = this.cliente.recnum ? 'PUT' : 'POST';
            const url = this.cliente.recnum ? `/api/cliente/${this.cliente.codigo}` : '/api/cliente';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(this.cliente)
            }).then(response => {
                if (!response.ok) {
                    throw response;
                }
                return response.json();
            }).then(data => {
                this.$router.push('/cliente');
                this.formErrors = {};
            }).catch(error => {
                error.json().then(err => {
                    this.formErrors = err.errors;
                });
            });
        }
    }
}
</script>
