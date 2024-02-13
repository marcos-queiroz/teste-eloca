import { createRouter, createWebHistory } from 'vue-router';

// Importe seus componentes
import HomePage from '../components/HomePage.vue';

import EmpresaList from '../components/EmpresaList.vue';
import EmpresaForm from '../components/EmpresaForm.vue';

import ClienteList from '../components/ClienteList.vue';
import ClienteForm from '../components/ClienteForm.vue';

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
    {
        path: '/cliente/nova',
        name: 'NovoCliente',
        component: ClienteForm,
    },
    {
        path: '/cliente/editar/:codigo',
        name: 'EditarCliente',
        component: ClienteForm
    },
];

// Crie o router
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
