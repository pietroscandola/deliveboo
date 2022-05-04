<template>
  <section>
      <h1>{{ category.name }}</h1>

    <RestaurantCard />
  </section>
</template>

<script>
import Loader from "../Loader.vue";
import RestaurantCard from "./RestaurantCard.vue";


export default {
    name: "RestaurantByCategory",
    components: {
        Loader,
        RestaurantCard,
    },
    data(){
        return {
            isLoading: false,

        }
    }
}
</script>

<style>

</style>