const MainRoutes = {
    path: '/',
    meta: { requiresAuth: true },
    redirect: '/',
    component: () => import('../layouts/full/FullLayout.vue'),
    children: [
        {
            name: 'Starter',
            path: '/sample-page',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/SamplePage.vue')
        },
        {
            name: 'Products',
            path: '/produtos',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Products.vue')
        },
        {
            name: 'Orders',
            path: '/pedidos',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Orders.vue')
        },
        {
            name: 'Users',
            path: '/usuarios',
            meta: { requiresAuth: true },
            component: () => import('../views/pages/Users.vue')
        },
       
    ]
};

export default MainRoutes;
