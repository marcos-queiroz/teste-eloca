<template>
    <base-template>
        <h1>Clientes</h1>
        <ul>
            <li v-for="cliente in clientes" :key="cliente.id">
                {{ cliente.razao_social }}
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
}
</script>
