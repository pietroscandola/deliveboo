import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import RestaurantShow from './components/pages/RestaurantShow.vue'

const router = new VueRouter({
    
    mode: 'history',
    linkExactActiveClass: 'active',

    routes: [
        {path: '/', component: Home, name: 'home'},
        {path: '/restaurants/:id', component: RestaurantShow, name: 'restaurant-details'},
    ]
});

export default router;