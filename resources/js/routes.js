import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import RestaurantShow from './components/pages/RestaurantShow.vue'
import Cart from './components/pages/Cart.vue';

const router = new VueRouter({
    
    mode: 'history',
    linkExactActiveClass: 'active',

    routes: [
        {path: '/', component: Home, name: 'home'},
        {path: '/restaurants/:id', component: RestaurantShow, name: 'restaurant-details'},
        {path: '/restaurants/:name', component: RestaurantShow, name: 'restaurant-categories'},
        {path: '/cart', component: Cart, name: 'cart'}
    ]
});

export default router;