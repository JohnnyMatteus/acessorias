const AuthRoutes = {
    path: '/auth',
    component: () => import('../layouts/blank/BlankLayout.vue'),
    meta: {
        requiresAuth: false
    },
    children: [

        {
            name: 'Login',
            path: '/auth/login',
            component: () => import('../views/authentication/BoxedLogin.vue')
        },
        {
            name: 'Register',
            path: '/auth/register',
            component: () => import('../views/authentication/BoxedRegister.vue')
        },
        {
            name: 'Forgot',
            path: '/auth/forgot',
            component: () => import('../views/authentication/BoxedForgot.vue')
        },
        {
            name: 'ResetPassword',
            path: '/auth/reset-password',
            component: () => import('../views/authentication/BoxedResetPassword.vue'),
        },
    ]
};

export default AuthRoutes;
