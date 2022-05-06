<template>
  <section id="home">
    <Loader v-if="isLoading" />
    <!-- CARD -->
    <div
      v-if="!isLoading"
      id="categories-container"
      class="d-flex justify-content-center mb-4"
    >
      <!-- <div v-for="category in categories" :key="category.id">
        <CategoryCard :category="category" />
      </div> -->
      <ul class="object administrator-checkbox-list">
        <li v-for="category in categories" :key="category.id">
          <label v-bind:for="category.id">
            <input
              type="checkbox"
              v-model="checked_categories"
              v-bind:value="category"
              v-bind:id="category.id"
            />
            <span>{{ category.name }}</span>
          </label>
        </li>
      </ul>
    </div>
    <div v-if="!checked_categories.length">
      <RestaurantList />
    </div>
    <div v-else>
      <div v-for="checked in checked_categories" :key="checked.id">
        <p>{{ checked.name }}</p>
        <ul v-for="restaurant in checked.restaurants" :key="restaurant.id">
          <li>{{ restaurant.name }}</li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
import RestaurantList from "../restaurants/RestaurantsList.vue";
import CategoryCard from "../categories/CategoryCard.vue";
import Loader from "../Loader.vue";

import "@fontsource/ibm-plex-sans";

export default {
  name: "Home",
  components: {
    RestaurantList,
    CategoryCard,
    Loader,
  },
  data() {
    return {
      categories: [],
      checked_categories: [],
      isLoading: false,
    };
  },
  methods: {
    getCategories() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/categories")
        .then((res) => {
          const categories = res.data;
          this.categories = categories;
          console.log(categories);
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("OK CATEGORIES API");
        });
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap");
body {
  font-family: "IBM Plex Sans", sans-serif;
}
</style>