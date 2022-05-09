import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import RestaurantShow from './components/pages/RestaurantShow.vue'
import RestaurantByCategory from './components/pages/RestaurantByCategory.vue'
import CheckoutPage from './components/pages/CheckoutPage.vue';

const router = new VueRouter({

        mode: 'history',
        linkExactActiveClass: 'active',

        routes: [
                { path: '/', component: Home, name: 'home' },
                { path: '/restaurants/:id', component: RestaurantShow, name: 'restaurant-details' },
                { path: '/categories/:id', component: RestaurantByCategory, name: 'restaurant-categories' },
                { path: '/checkout', component: CheckoutPage, name: 'checkout' }
        ]
});

export default router;