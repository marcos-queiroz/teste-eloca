<template>
    <div>
        <nav-bar></nav-bar>
        <div class="container py-5">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import NavBar from './NavBar.vue';

export default {
    components: {
        NavBar,
    },
};
</script>

<style scoped></style>
