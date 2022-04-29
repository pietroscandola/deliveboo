<template>
   <section id="home">
      <RestaurantList />
   </section>
</template>

<script>
import RestaurantList from "../restaurants/RestaurantsList.vue";

export default {
   name: "Home",
   components: {
      RestaurantList,
   },
};
</script>

<style>
</style>