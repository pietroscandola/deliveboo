<template>
  <section id="home" class="py-3 container">
    <Loader v-if="isLoading" />
    <!-- CHECKBOXES -->
    <div class="checkbox-container">
      <h5 class="p-2">Filtro Categorie:</h5>
      <ul class="object administrator-checkbox-list d-flex flex-wrap">
        <li
          class="d-inline mr-3"
          v-for="category in categories"
          :key="category.id"
          @click="$refs.RestaurantList.getRestaurants()"
        >
          <label v-bind:for="category.id" role="button">
            <input
              type="checkbox"
              v-model="checked_categories"
              :value="category.id"
              :id="category.id"
            />

            <span class="card-text">{{ category.name }}</span>
          </label>
        </li>
      </ul>
    </div>

    <RestaurantList
      ref="RestaurantList"
      :checked_categories="checked_categories"
    />
    <!-- <RestaurantByCategory
      ref="RestaurantByCategory"
      v-else
      :checked_categories="checked_categories"
    /> -->
  </section>
</template>

<script>
import RestaurantList from "../restaurants/RestaurantsList.vue";
import RestaurantByCategory from "./RestaurantByCategory.vue";
import CategoryCard from "../categories/CategoryCard.vue";
import Loader from "../Loader.vue";

import "@fontsource/ibm-plex-sans";

export default {
  name: "Home",
  components: {
    RestaurantList,
    CategoryCard,
    Loader,
    RestaurantByCategory,
  },
  data() {
    return {
      categories: [],
      checked_categories: [],
      isLoading: false,
      isActive: false,
    };
  },
  methods: {
    getCategories() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/categories")
        .then((res) => {
          const categories = res.data;
          this.categories = categories;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("OK CATEGORIES API");
        });
    },
    // CHECKBOX DYNAMIC ACTIVE
    setActiveClass() {
      if (this.isActive) {
        this.isActive = false;
      } else {
        this.isActive = true;
      }
    },
  },
  mounted() {
    this.getCategories();
  },
  computed: {
    filteredCategory() {
      const filteredRestaurants = this.checked_categories
        .map((category) => this.categories[category]?.restaurants || [])
        .flat();

      if (!filteredRestaurants.length) {
        return [];
      }

      const ids = filteredRestaurants.map((restaurant) => restaurant.id);

      return filteredRestaurants.filter(
        ({ id }, index) => !ids.includes(id, index + 1)
      );
    },
  },
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap");
body {
  font-family: "IBM Plex Sans", sans-serif;
}

// CUSTOM CATEGORIES CHECKBOXES
.checkbox-container {
  box-shadow: 0px 0px 12px 12px rgba(208, 208, 208, 0.66),
    inset 2px 2px 10px 0px rgba(208, 208, 208, 0.4);
  border-radius: 15px;
}
h5 {
  font-size: 30px;
  font-weight: 900;
  text-align: center;
}
.custom-checkbox {
  height: 50px;
  color: white;
  font-weight: bolder;
  text-decoration: none;
  text-shadow: 1px 1px 2px rgba($color: #000000, $alpha: 0.8);
}
.card-checkbox-body {
  background-image: url("https://consumer-component-library.roocdn.com/25.30.2/static/images/placeholder.svg");
  background-position: center;
  block-size: cover;
}
.active-checkbox {
  box-shadow: 0 0 0 1px red;
}
html {
  scroll-behavior: smooth;
}
</style>