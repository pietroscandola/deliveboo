<template>
  <div id="restaurant-list" class="container-fluid container-md">
    <h1>Ristoranti che consegnano a Piazza Venezia</h1>
    <Loader v-if="isLoading" />
    <div v-else class="row">
      <div
        v-for="restaurant in filteredRestaurants"
        :key="restaurant.id"
        class="col-sm-6 col-md-4 col-xl-3"
      >
        <RestaurantCard
          :checked_categories="checked_categories"
          :restaurant="restaurant"
        />
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
      filteredRestaurants: [],
      filteredCategories: [],
      categoriesIDs: [],
    };
  },
  methods: {
    getRestaurants() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/restaurants")
        .then((res) => {
          console.log("if");
          this.filteredCategories = [];

          if (!this.checked_categories.length) {
            const restaurants = res.data;
            this.filteredRestaurants = restaurants;
          } else {
            console.log("else");
            this.filteredRestaurants = [];
            res.data.forEach((restaurant) => {
              restaurant["categories"].forEach((category) => {
                this.categoriesIDs = [];
                this.categoriesIDs.push(category.id);
                console.log("categories nel foreach", this.categoriesIDs);

                const restaurantFilterCondition = (currentValue) =>
                  this.categoriesIDs.includes(currentValue);
                console.log(
                  this.checked_categories.every(restaurantFilterCondition)
                );
              });

              // console.log("restaurant", restaurant);
              // const restaurantFilterCondition = (currentValue) =>
              //   restaurant["categories"].includes(currentValue);
              // console.log(
              //   this.checked_categories.every(restaurantFilterCondition)
              // );
            });
          }
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