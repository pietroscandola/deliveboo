<template>
  <section id="home">
    <!-- CARD -->
    <div id="categories-container" class="d-flex justify-content-center">
      <div v-for="category in categories" :key="category.id">
        <router-link
          :to="{ name: 'restaurant-categories', params: { id: category.id } }"
        >
          <div class="card">
            <img src="#" class="card-img-top" alt="#" />
            <div class="card-body">
              <p class="card-text">{{ category.name }}</p>
            </div>
          </div>
        </router-link>
      </div>
    </div>

    <RestaurantList />
  </section>
</template>

<script>
import RestaurantList from "../restaurants/RestaurantsList.vue";

import "@fontsource/ibm-plex-sans";

export default {
  name: "Home",
  components: {
    RestaurantList,
  },
  data() {
    return {
      categories: [],
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
        });
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap");
body {
  font-family: "IBM Plex Sans", sans-serif;
}
</style>