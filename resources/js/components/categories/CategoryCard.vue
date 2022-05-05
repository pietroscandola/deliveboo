<template>

  <div>

    <div class="card mr-3" @click="myFilter()" :class="{active: isActive}">
      <div class="card-body">
        <p class="card-text">{{ category.name }}</p>
      </div>
    </div>

  </div>


</template>

<script>
export default {
  name: "CategoryCard",
  props: ["category"],
  data() { 
    return {
      isActive : false,

    }
  },
  methods: {
    myFilter() {
     
      if (this.isActive) {
        this.isActive = false;
      } else {
        this.isActive = true;
      }
  }
  }
};
</script>

<style scoped lang="scss">
a {
  color: white;
  font-weight: bolder;
  text-decoration: none;
  text-shadow: 1px 1px 2px rgba($color: #000000, $alpha: 0.8);
}
.card-body {
  background-image: url("https://consumer-component-library.roocdn.com/25.30.2/static/images/placeholder.svg");
  background-position: center;
  block-size: cover;
}
.active {
  outline: 2px solid blue;
  cursor: pointer;
}
</style>