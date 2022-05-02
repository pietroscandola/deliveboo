<template>
  <section id="home">
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
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap");
body {
  font-family: "IBM Plex Sans", sans-serif;
}
</style>