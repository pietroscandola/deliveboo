<template>
  <div id="restaurant-list" class="container-fluid container-md">
    <h1>Ristoranti che consegnano a Piazza Venezia</h1>
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
  props: ["checked_categories"],
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
    getFilteredRestaurants() {
      setTimeout(() => {
        console.log("restaurants", this.restaurants);
        console.log("restaurants categories", this.restaurants["categories"]);
      }, 5000);
      // const category_checker = this.checked_categories.every(
      //   (checked_category) => {
      //     return this.restaurants["categories"].includes(checked_category);
      //   }
      // );
      // if (category_checker) {
      //   console.log("true");
      // } else {
      //   console.log("false");
      // }
    },
  },
  mounted() {
    this.getRestaurants();
    this.getFilteredRestaurants();
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