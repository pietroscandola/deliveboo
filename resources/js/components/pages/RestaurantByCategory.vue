<template>
  <section id="restaurants-by-category" class="row">
    <Loader v-if="isLoading" />
    <!-- Titolo -->
    <div class="col-12 d-flex align-items-center">
      <!-- Lista dei Ristoranti -->
      <div
        v-for="restaurant in arraySenzaDuplicati"
        :key="restaurant.id"
        class="col-sm-6 col-md-4 col-xl-3"
      >
        <RestaurantCard :restaurant="restaurant" />
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
  props: ["checked_categories"],
  data() {
    return {
      selected_categories: [],
      arrayOriginale: [],
      arraySenzaDuplicati: [],
      isLoading: false,
      // test: [4, 5],
    };
  },
  methods: {
    getRestaurantsFilteredByCategories() {
      this.arrayOriginale = [];
      this.selected_categories.forEach((category) => {
        console.log(category);
        category["restaurants"].forEach((restaurant) => {
          this.arrayOriginale.push(restaurant);
        });
      });

      var result = this.arrayOriginale.reduce((unique, o) => {
        if (!unique.some((obj) => obj.id === o.id)) {
          unique.push(o);
        }
        return unique;
      }, []);

      this.arraySenzaDuplicati = result;
    },
    getCategoryInHome() {
      this.isLoading = true;
      setTimeout(() => {
        this.getCategory();
      }, 300);
    },
    getCategory() {
      let qs = require("qs");
      const newtest = this.checked_categories.map((cat, i) => {
        const container = {};
        const key = "cid" + i;

        container[key] = cat;

        return container;
      });

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
          this.selected_categories = category;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("OK API");
          this.getRestaurantsFilteredByCategories();
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