<template>
  <div id="restaurant-list" class="container-fluid container-md">
    <h1>Ristoranti che consegnano a Piazza Venezia</h1>
    <button @click="getFilteredRestaurants()">vincenzo</button>
    <Loader v-if="isLoading" />
    <div v-else class="row">
      <div
        v-for="restaurant in restaurants"
        :key="restaurant.id"
        class="col-sm-6 col-md-4 col-xl-3"
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
      filteredRestaurants: [],
    };
  },
  methods: {
    getFilteredRestaurants() {
      this.restaurants.forEach((restaurant) => {
        restaurant["categories"].forEach((category) => {
          if (category["id"] == 4) {
            this.filteredRestaurants.push(restaurant);
          }
        });
      });
      // const result = this.restaurants.filter(
      //   (restaurant) => restaurant["category"] != filteredRestaurant["id"]
      // );
    },
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

<style lang="scss" scoped>
@import "../../../sass/_variables.scss";

h1 {
  font-weight: 700;
  font-size: 30px;
  margin-bottom: 24px;
  margin-top: 13px;
  color: $main-black;
}
</style>