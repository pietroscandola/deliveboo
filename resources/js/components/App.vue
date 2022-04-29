<template>
   <div class="container">
      <router-view></router-view>
   </div>
</template>

<script>
export default {
   name: "App",
   component: {},
   data() {
      return {
         restaurants: [],
      };
   },
   methods: {
      getRestaurants() {
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
               console.log("OK API");
            });
      },
   },
   mounted() {
      console.log("Component mounted.");
      this.getRestaurants();
   },
};
</script>
