<template>
  <section id="restaurants-by-category" class="row">
    <button @click="getCategory()">CHIAMATA API</button>
    <Loader v-if="isLoading" />
    <!-- Titolo -->
    <div class="col-12 d-flex justify-content-between align-items-center">
      <h1 class="mb-3">nome categoria</h1>
      <router-link :to="{ name: 'home' }">Torna ai ristoranti</router-link>
    </div>
    <!-- Lista dei Ristoranti -->
    <div class="col-12">
      <ul>
        <li v-for="restaurant in arraySenzaDuplicati" :key="restaurant.id">
          {{ restaurant.name }}
        </li>
      </ul>
    </div>
    <button @click="getRestaurantsFilteredByCategories()">
      getRestaurantsFilteredByCategories
    </button>
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
  props: ["checked_categories"],
  data() {
    return {
      categories: [],
      arrayOriginale: [],
      arraySenzaDuplicati: [],
      isLoading: false,
      test: [4, 5],
    };
  },
  methods: {
    getRestaurantsFilteredByCategories() {
      this.arrayOriginale = [];
      this.categories.forEach((category) => {
        console.log(category);
        category["restaurants"].forEach((restaurant) => {
          this.arrayOriginale.push(restaurant);
        });
      });

      this.arrayOriginale.forEach((restaurant) => {
        Vue.delete(restaurant, "pivot");
      });

      var result = this.arrayOriginale.reduce((unique, o) => {
        if (!unique.some((obj) => obj.id === o.id)) {
          unique.push(o);
        }
        return unique;
      }, []);

      this.arraySenzaDuplicati = result;

      // this.arrayOriginale.forEach((restaurant) => {
      //   if (!this.arraySenzaDuplicati.includes(restaurant)) {
      //     this.arraySenzaDuplicati.push(restaurant);
      //   }
      // });

      // this.arrayOriginale.forEach((filteredRestaurant) => {
      //   const result = this.arrayOriginale.filter(
      //     (restaurant) => restaurant["id"] != filteredRestaurant["id"]
      //   );

      //   this.arraySenzaDuplicati = result;
      // });
    },
    getCategory() {
      let qs = require("qs");
      const newtest = this.checked_categories.map((cat, i) => {
        const container = {};
        const key = "cid" + i;

        container[key] = cat;

        return container;
      });
      /* console.log("NO JSON", this.test);
         console.log("JSON", JSON.stringify(this.test)); */

      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/categories/filter", {
          params: newtest,
          paramsSerializer: (params) => {
            console.log(params);
            return qs.stringify(params);
          },
        })
        .then((res) => {
          const category = res.data;
          console.log("res.data", res.data);
          this.categories = category;
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
  computed: {},
  mounted() {
    this.getCategory();
  },
};
</script>

<style>
</style>