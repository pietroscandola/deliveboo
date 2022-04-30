<template>
   <div id="restaurant-show">
      <!-- Loader visibile fin che la chiamata axios non finisce -->
      <Loader v-if="isLoading" />
      <div v-else class="row">
         <!-- RISTORANTE -->
         <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <h5 class="m-0">{{ restaurant.name }}</h5>
                  <div v-if="restaurant.categories" class="categories-box">
                     <span
                        v-for="category in restaurant.categories"
                        :key="category.id"
                        class="badge badge-primary mx-1"
                     >
                        {{ category.name }}
                     </span>
                  </div>
               </div>
               <div class="card-body d-flex">
                  <img
                     class="w-25"
                     src="https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"
                     alt="R"
                  />
                  <div class="ml-3">
                     <h5 class="card-title">{{ restaurant.address }}</h5>
                     <p class="card-text">
                        {{ restaurant.description }}
                     </p>
                     <button class="btn btn-primary" @click="$router.back()">
                        Indietro
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <!-- PRODOTTI -->
         <div class="col-12 mt-3">
            <h2>Prodotti</h2>
         </div>
         <div v-for="product in products" :key="product.id" class="col-3">
            <div class="card my-3">
               <img
                  v-if="product.image"
                  class="card-img-top"
                  :src="'/storage/' + product.image"
                  alt="Card image cap"
               />
               <div class="card-body">
                  <h5>{{ product.name }}</h5>
                  <p class="card-text">REE</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import Loader from "../Loader.vue";

export default {
   name: "RestaurantShow",
   components: {
      Loader,
   },
   data() {
      return {
         isLoading: false,
         restaurant: {},
         products: [],
      };
   },
   methods: {
      getRestaurant() {
         this.isLoading = true;
         axios
            .get(
               "http://localhost:8000/api/restaurants/" + this.$route.params.id
            )
            .then((res) => {
               const { products, ...restaurant } = res.data;
               this.products = products;
               this.restaurant = restaurant;
            })
            .catch((err) => {
               console.error(err);
            })
            .then(() => {
               this.isLoading = false;
               console.log("OK API");
            });
      },
   },
   mounted() {
      this.getRestaurant();
   },
};
</script>

<style>
</style>