<template>
  <section>
    <h1>{{ category.name }}</h1>
    <div class="restaurants">
      <h3 v-for="restaurant in category.restaurants" :key="restaurant.id">
        {{ restaurant.name }}
      </h3>
    </div>
  </section>
</template>

<script>
export default {
  name: "RestaurantByCategory",
  components: {},
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