<template>
   <router-link
      :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
   >
      <div class="restaurant-card">
         <div class="card-top">
            <img
               v-if="ifLink"
               class="img-fluid"
               style="object-fit: cover; height: 100%; width: 100%"
               :src="restaurant.image"
               :alt="restaurant.name"
            />
            <img
               v-else
               class="img-fluid"
               style="object-fit: cover; height: 100%; width: 100%"
               :src="'../storage/' + restaurant.image"
               :alt="restaurant.name"
            />
         </div>
         <div class="card-bottom p-3">
            <h5>{{ restaurant.name }}</h5>
            <p>{{ restaurant.description.substring(0, 100) + "..." }}</p>
            <div class="category-badge-container">
               <span
                  class="category-badge"
                  v-for="category in restaurant.categories"
                  :key="category.id"
                  >{{ category.name }}</span
               >
            </div>
         </div>
      </div>
   </router-link>
</template>

<script>
export default {
   name: "RestaurantCard",
   props: ["restaurant", "checked_categories"],
   computed: {
      ifLink() {
         return this.restaurant.image.includes("http");
      },
   },
};
</script>

<style scoped lang="scss">
a {
   color: black;
   &:hover {
      text-decoration: none;
      color: black;
   }
   .restaurant-card {
      height: 300px;
      margin-bottom: 15px;
      border: 4px solid #00ccbc;
      border-radius: 30px;
      .card-top {
         height: 55%;
         /* background-image: url("https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"); */
         background-position: center;
         background-size: cover;
         border-radius: 5px 5px 0 0;
         .img-fluid {
            border-radius: 25px 25px 0 0;
         }
      }
      .card-bottom {
         background-color: #dedede;
         height: 45%;
         border-radius: 0 0 25px 25px;
         h5 {
            font-weight: 700;
            font-size: 16px;
         }
         p {
            font-size: 14px;
            line-height: 15px;
            color: #585c5c;
         }
         .category-badge-container {
            position: absolute;
            top: 15px;
            right: 30px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-end;
            .category-badge {
               padding: 1px 3px;
               font-weight: bolder;
               background-image: linear-gradient(90deg, #d73c31, #a62f26);
               color: white;
               margin-bottom: 3px;
               border-radius: 8px;
               box-shadow: 0 0 6px rgba(230, 230, 230, 0.5);
            }
         }
      }
   }
}
</style>