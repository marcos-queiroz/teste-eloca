<template>
    <div>
        <nav-bar></nav-bar>
        <!-- Inclua outros componentes globais padrões aqui, como um <footer-bar></footer-bar>, se necessário -->
        <slot></slot> <!-- Este slot permitirá que você injete conteúdo específico da página. -->
    </div>
</template>

<script>
import NavBar from './NavBar.vue';

export default {
    components: {
        NavBar,
        // Outros componentes globais podem ser registrados aqui
    },
};
</script>

<!-- Adicione estilos globais padrões aqui, se necessário -->
<style scoped></style>
