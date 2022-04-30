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
      <div class="restaurant-content d-flex justify-content-between">
         <!-- Restaurant name -->
         <div>
            <h5 class="card-title">{{ restaurant.name }}</h5>
         </div>
         <!-- Categories -->
         <div
            v-if="restaurant.categories"
            class="categories-box d-flex flex-column m-1"
         >
            <span
               v-for="category in restaurant.categories"
               :key="category.id"
               class="badge badge-primary my-1"
               >{{ category.name }}</span
            >
         </div>
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
   .restaurant-content {
      position: absolute;
      width: 100%;
      height: 100%;

      h5 {
         color: white;
         background-color: rgba(0, 0, 0, 0.75);
         padding: 5px 10px;
         border-radius: 5px;
      }
   }
}
</style>