<template>
   <div class="container">
      <div class="row">
         <div
            v-for="restaurant in restaurants"
            :key="restaurant.id"
            class="col-4"
         >
            <div class="card my-3" style="width: 18rem">
               <!-- <img class="card-img-top" src="..." alt="Card image cap" /> -->
               <div class="card-body">
                  <h5 class="card-title">{{ restaurant.name }}</h5>
                  <p class="card-text">
                     {{ restaurant.description }}
                  </p>
                  <a href="#" class="btn btn-primary">Vedi piatti</a>
               </div>
            </div>
         </div>
      </div>
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
