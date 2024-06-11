import { createRouter, createWebHistory } from 'vue-router';
import auth from '../services/auth';

// Definindo rotas principais
const MainRoutes = {
    path: '/',
    meta: { requiresAuth: true },
    component: () => import('../layouts/full/FullLayout.vue'),
    children: [
        {
            name: 'Starter',
            path: 'sample-page',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/SamplePage.vue')
        },
        {
            name: 'Products',
            path: 'produtos',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Products.vue')
        },
        {
            name: 'Orders',
            path: 'pedidos',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Orders.vue')
        },
        {
            name: 'Users',
            path: 'usuarios',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Users.vue')
        }
    ]
};

// Definindo rotas de autenticação
const AuthRoutes = {
    path: '/auth',
    component: () => import('../layouts/blank/BlankLayout.vue'),
    meta: { requiresAuth: false },
    children: [
        {
            name: 'Login',
            path: 'login',
            component: () => import('../views/authentication/BoxedLogin.vue')
        },
        {
            name: 'Register',
            path: 'register',
            component: () => import('../views/authentication/BoxedRegister.vue')
        },
        {
            name: 'Forgot',
            path: 'forgot',
            component: () => import('../views/authentication/BoxedForgot.vue')
        },
        {
            name: 'ResetPassword',
            path: 'reset-password',
            component: () => import('../views/authentication/BoxedResetPassword.vue')
        }
    ]
};

// Definindo rota de erro 404
const ErrorRoute = {
    path: '/:pathMatch(.*)*',
    component: () => import('../views/authentication/Error.vue')
};

// Unindo todas as rotas
const routes = [
    MainRoutes,
    AuthRoutes,
    ErrorRoute
];

// Criando o roteador
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

// Adicionando guarda de rota
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!auth.isAuthenticated()) {
            if (to.name !== 'Login') {
                next({ name: 'Login', query: { redirect: to.fullPath } });
                return;
            }
        }
    }
    next();
});

export default router;
