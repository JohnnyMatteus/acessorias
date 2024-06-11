const AuthRoutes = [
    {
        path: '/auth',
        component: () => import('../layouts/blank/BlankLayout.vue'),
        meta: {
            requiresAuth: false
        },
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
            },
        ]
    }
];

export default AuthRoutes;
