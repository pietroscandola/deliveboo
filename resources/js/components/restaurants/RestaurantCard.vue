<template>
   <router-link
      :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
      class="card my-3"
   >
      <img
         class="card-img-top"
         src="https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"
         alt="Card image cap"
      />
      <div class="card-body">
         <h5 class="card-title">{{ restaurant.name }}</h5>
      </div>
   </router-link>
</template>

<script>
export default {
   name: "RestaurantCard",
   props: ["restaurant"],
};
</script>

<style scoped lang="scss">
.card {
   position: relative;
   .card-body {
      position: absolute;
      h5 {
         color: white;
         background-color: rgba(0, 0, 0, 0.5);
         padding: 5px 10px;
         border-radius: 5px;
      }
   }
}
</style>