<template>
   <div id="restaurant-list" class="container-fluid container-md">
      <Loader v-if="isLoading" />
      <div v-else class="row">
         <div
            v-for="restaurant in restaurants"
            :key="restaurant.id"
            class="col-sm-6 col-md-4"
         >
            <RestaurantCard :restaurant="restaurant" />
         </div>
      </div>
   </div>
</template>

<script>
import RestaurantCard from "./RestaurantCard.vue";
import Loader from "../Loader.vue";

export default {
   name: "RestaurantList",
   components: {
      RestaurantCard,
      Loader,
   },
   data() {
      return {
         isLoading: false,
         restaurants: [],
      };
   },
   methods: {
      getRestaurants() {
         this.isLoading = true;
         axios
            .get("http://localhost:8000/api/restaurants")
            .then((res) => {
               const restaurants = res.data;
               this.restaurants = restaurants;
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
      this.getRestaurants();
   },
};
</script>

<style>
</style>