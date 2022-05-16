export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/biddings', component: require('./components/Biddings.vue').default },
    { path: '/products', component: require('./components/product/Products.vue').default },
    { path: '/categories', component: require('./components/Categories.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
