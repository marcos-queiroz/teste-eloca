<template>
    <base-template>
        <div class="card">
            <form @submit.prevent="submitForm">
                <div class="card-header">
                    <h2>
                        {{ empresa.recnum ? 'Editar' : 'Cadastrar' }} Empresa
                    </h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div v-if="!empresa.recnum" class="col-md-2 form-group">
                            <label for="codigo" class="form-label">
                                Código
                            </label>
                            <input type="text" class="form-control" id="codigo" v-model="empresa.codigo">
                            <div v-if="formErrors.codigo" class="text-danger">
                                {{ formErrors.codigo[0] }}
                            </div>
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="empresa" class="form-label">
                                Empresa
                            </label>
                            <input type="text" class="form-control" id="empresa" v-model="empresa.empresa">
                            <div v-if="formErrors.empresa" class="text-danger">
                                {{ formErrors.empresa[0] }}
                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="sigla" class="form-label">
                                Sigla
                            </label>
                            <input type="text" class="form-control" id="sigla" v-model="empresa.sigla">
                            <div v-if="formErrors.sigla" class="text-danger">
                                {{ formErrors.sigla[0] }}
                            </div>
                        </div>

                        <div class="form-group" :class="empresa.recnum ? 'col-md-7' : 'col-md-5'">
                            <label for="razao_social" class="form-label">
                                Razão social
                            </label>
                            <input type="text" class="form-control" id="razao_social" v-model="empresa.razao_social">
                            <div v-if="formErrors.razao_social" class="text-danger">
                                {{ formErrors.razao_social[0] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <router-link to="/empresa" class="btn btn-secondary">
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
            empresa: {},
            formErrors: {}
        };
    },

    async mounted() {
        if (this.$route.params.codigo) {
            const response = await fetch(`/api/empresa/${this.$route.params.codigo}`);
            const data = await response.json();
            this.empresa = data;
        }
    },

    methods: {
        submitForm() {
            const method = this.empresa.recnum ? 'PUT' : 'POST';
            const url = this.empresa.recnum ? `/api/empresa/${this.empresa.codigo}` : '/api/empresa';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(this.empresa)
            }).then(response => {
                if (!response.ok) {
                    throw response;
                }
                return response.json();
            }).then(data => {
                this.$router.push('/empresa');
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
