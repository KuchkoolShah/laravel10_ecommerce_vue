import { createWebHistory, createRouter } from 'vue-router'
import test from './test.vue'
import Layouts from './frontTemplate/Layouts.vue'
import Index from './frontTemplate/Index.vue'

const routes = [

    {
        name: 'Index',
        path: '/',
        component:Index,

    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
