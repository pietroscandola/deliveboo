<template>
  <section id="home">
    <Loader v-if="isLoading" />
    <!-- CHECKBOXES -->
    <ul
      class="object administrator-checkbox-list d-flex justify-content-center"
    >
      <li
        class="d-inline mr-3"
        v-for="category in categories"
        :key="category.id"
        @click="$refs.RestaurantByCategory.getCategoryInHome()"
      >
        <label
          @click="setActiveClass()"
          v-bind:for="category.id"
          role="button"
          class="custom-checkbox"
        >
          <input
            class="d-none"
            type="checkbox"
            v-model="checked_categories"
            :value="category.id"
            :id="category.id"
          />
          <!-- STYLE -->
          <div
            class="card"
            @click="setActiveClass()"
            :class="{ 'active-checkbox': isActive }"
          >
            <div class="card-body card-checkbox-body">
              <p class="card-text">{{ category.name }}</p>
            </div>
          </div>
        </label>
      </li>
    </ul>
    <!-- CARD -->
    <!-- <div
      v-if="!isLoading"
      id="categories-container"
      class="d-flex justify-content-center mb-4"
    >
      <div v-for="category in categories" :key="category.id">
        <CategoryCard :category="category" />
      </div>
    </div> -->

    <RestaurantList v-if="!checked_categories.length" />
    <RestaurantByCategory
      ref="RestaurantByCategory"
      v-else
      :checked_categories="checked_categories"
    />
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
          console.log(categories);
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
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap");
body {
  font-family: "IBM Plex Sans", sans-serif;
}

// CUSTOM CATEGORIES CHECKBOXES
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
</style>