<template>
  <section id="restaurants-by-category" class="row">
    <!-- Titolo -->
    <div class="col-12 d-flex justify-content-between align-items-center">
      <h1 class="mb-3">{{ category.name }}</h1>
      <router-link :to="{ name: 'home' }">Torna ai ristoranti</router-link>
    </div>
    <!-- Lista dei Ristoranti -->
    <div class="col-12">
      <div class="row">
        <RestaurantCard
          class="col-4"
          v-for="restaurant in category.restaurants"
          :key="restaurant"
          :restaurant="restaurant"
        />
      </div>
    </div>
  </section>
</template>

<script>
import RestaurantCard from "../restaurants/RestaurantCard.vue";

export default {
  name: "RestaurantByCategory",
  components: {
    RestaurantCard,
  },
  data() {
    return {
      category: {},
    };
  },
  methods: {
    getCategory() {
      axios
        .get("http://localhost:8000/api/categories/" + this.$route.params.id)
        .then((res) => {
          const category = res.data;
          this.category = category;
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
    this.getCategory();
  },
};
</script>

<style>
</style>