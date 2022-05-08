<template>
   <section id="restaurants-by-category" class="row">
      <Loader v-if="isLoading" />
      <!-- Titolo -->
      <div class="col-12 d-flex justify-content-between align-items-center">
         <h1 class="mb-3">nome categoria</h1>
         <router-link :to="{ name: 'home' }">Torna ai ristoranti</router-link>
      </div>
      <!-- Lista dei Ristoranti -->
      <div class="col-12">
         <div class="row">
            <!-- <RestaurantCard
               class="col-4"
               v-for="restaurant in category.restaurants"
               :key="restaurant.id"
               :restaurant="restaurant"
            /> -->
            <!-- BY CATEGORIES -->
            <div v-for="category in categories" :key="category.id">
               <p>{{ category.name }}</p>
               <p>{{ category.id }}</p>
               <div
                  v-for="restaurant in category.restaurants"
                  :key="restaurant.id"
               >
                  <p>nome: {{ restaurant.name }}</p>
               </div>
            </div>
         </div>
      </div>
   </section>
</template>

<script>
import RestaurantCard from "../restaurants/RestaurantCard.vue";
import Loader from "../Loader.vue";

export default {
   name: "RestaurantByCategory",
   components: {
      RestaurantCard,
      Loader,
   },
   data() {
      return {
         categories: {},
         isLoading: false,
         test: [4, 5],
      };
   },
   methods: {
      getCategory() {
         let qs = require("qs");
         const newtest = this.test.map((cat, i) => {
            const container = {};
            const key = "cid" + i;

            container[key] = cat;

            return container;
         });
         /* console.log("NO JSON", this.test);
         console.log("JSON", JSON.stringify(this.test)); */

         this.isLoading = true;
         axios
            .get("http://localhost:8000/api/categories/filter", {
               params: newtest,
               paramsSerializer: (params) => {
                  console.log(params);
                  return qs.stringify(params);
               },
            })
            .then((res) => {
               const category = res.data;
               console.log("res.data", res.data);
               this.categories = category;
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
      this.getCategory();
   },
};
</script>

<style>
</style>