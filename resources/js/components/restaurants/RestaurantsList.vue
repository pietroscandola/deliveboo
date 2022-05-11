<template>
  <div id="restaurant-list" class="container-fluid container-md">
    <Loader v-if="isLoading" />
    <div v-else>
      <h1>Ristoranti che consegnano a Piazza Venezia</h1>
      <div v-if="filteredRestaurants.length == 0">
        <h5>Sembra non esserci nessun ristorante per le categorie che hai selezionato! :(</h5>
      </div>
      <div class="row" v-else>
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
          this.categoriesIDs = [];

          if (!this.checked_categories.length) {
            const restaurants = res.data;
            this.filteredRestaurants = restaurants;
          } else {
            console.log("else");
            this.filteredRestaurants = [];
            res.data.forEach((restaurant) => {
              restaurant["categories"].forEach((category) => {
                this.categoriesIDs.push(category.id);

                const restaurantFilterCondition = (currentValue) =>
                  this.categoriesIDs.includes(currentValue);
                console.log(
                  this.checked_categories.every(restaurantFilterCondition)
                );
                if(this.checked_categories.every(restaurantFilterCondition) && !this.filteredRestaurants.includes(restaurant)) {
                  this.filteredRestaurants.push(restaurant);
                }
              });
              console.log("categories nel foreach", this.categoriesIDs);
              this.categoriesIDs = []

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
    getFilteredRestaurants() {
      setTimeout(() => {
        console.log("restaurants", this.restaurants);
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