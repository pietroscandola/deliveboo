<template>
  <section id="restaurants-by-category" class="py-3 container">
    <div class="row">
      <Loader v-if="isLoading" />
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
    </div>
  </section>
</template>

<script>
import RestaurantCard from "../restaurants/RestaurantCard.vue";
import Loader from "../Loader.vue";

export default {
  name: "RestaurantByCategory",
  components: {
    RestaurantCard,
    Loader,
  },
  data() {
    return {
      category: {},
      isLoading: false,
    };
  },
  methods: {
    getCategory() {
      this.isLoading = true;
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
          this.isLoading = false;
          console.log("OK API");
        });
    },
  },
  mounted() {
    this.getCategory();
  },
};
</script>

<style scoped lang="scss">
h1 {
  font-weight: 900;
}
</style>