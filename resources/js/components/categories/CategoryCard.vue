<template>
  <router-link
    :to="{ name: 'restaurant-categories', params: { id: category.id } }"
  >
    <div class="card">
      <img src="#" class="card-img-top" alt="#" />
      <div class="card-body">
        <p class="card-text">{{ category.name }}</p>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  name: "CategoryCard",
  props: ["category"],
};
</script>

<style>
</style>