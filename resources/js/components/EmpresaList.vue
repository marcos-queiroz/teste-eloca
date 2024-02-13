<template>
    <base-template>
        <h1>Empresas</h1>
        <ul>
            <li v-for="empresa in empresas" :key="empresa.id">
                {{ empresa.razao_social }}
            </li>
        </ul>
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
}
</script>
