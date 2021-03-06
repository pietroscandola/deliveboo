import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import RestaurantShow from './components/pages/RestaurantShow.vue'
import NotFoundPage from './components/pages/NotFoundPage.vue'
import RestaurantByCategory from './components/pages/RestaurantByCategory.vue'
import Cart from './components/pages/Cart.vue';

const router = new VueRouter({

        mode: 'history',
        linkExactActiveClass: 'active',

        routes: [
                { path: '/', component: Home, name: 'home' },
                { path: '/restaurants/:id', component: RestaurantShow, name: 'restaurant-details' },
                { path: '/categories/:id', component: RestaurantByCategory, name: 'restaurant-categories' },
                { path: '/cart/:id', component: Cart, name: 'cart' },
                { path: '/:pathMatch(.*)*', component: NotFoundPage, name: 'not-found' }
        ]
});

export default router;