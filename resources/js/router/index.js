import { createRouter, createWebHistory } from 'vue-router';

// Importe seus componentes
import HomePage from '../components/HomePage.vue';

import EmpresaList from '../components/EmpresaList.vue';
import EmpresaForm from '../components/EmpresaForm.vue';

import ClienteList from '../components/ClienteList.vue';

// Defina suas rotas
const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: HomePage,
    },
    {
        path: '/empresa',
        name: 'Empresa',
        component: EmpresaList,
    },
    {
        path: '/empresa/nova',
        name: 'NovaEmpresa',
        component: EmpresaForm,
    },
    {
        path: '/empresa/editar/:codigo',
        name: 'EditarEmpresa',
        component: EmpresaForm
    },
    {
        path: '/cliente',
        name: 'Cliente',
        component: ClienteList,
    },
];

// Crie o router
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
