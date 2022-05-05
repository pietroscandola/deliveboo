<template>
  <div class="cart-card card p-3">
    <h3 class="mb-3">Il tuo ordine</h3>
    <!-- Prodotti -->
    <div class="mb-3">
      <div v-for="product in cart" :key="product.id">
        <div class="product d-flex justify-content-between row">
          <div class="col-6">
            <!-- Product Name -->
            <span class="mb-1">{{ product.name }}</span>
          </div>
          <div class="col-6 d-flex justify-content-between">
            <!-- Buttons -->
            <div class="button-container">
              <i
                class="fa-solid fa-minus mr-1"
                role="button"
                @click="removeFromCart(product.id)"
              ></i>
              <span class="mr-1"> {{ product.quantity }} </span>
              <i
                class="fa-solid fa-plus mr-3"
                role="button"
                @click="addCart(product.id, product.name, product.price)"
              ></i>
            </div>
            <!-- Price -->
            <span>{{ getProductTotalPrice(product).toFixed(2) }} €</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Totale -->
    <div class="d-flex justify-content-between">
      <span><strong>Totale</strong></span>
      <span
        ><strong>{{ getTotal().toFixed(2) }} €</strong></span
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "RestaurantCart",
  props: ["cart"],
  methods: {
    getProductTotalPrice(product) {
      return product.quantity * product.price;
    },
    getTotal() {
      const cart = JSON.parse(sessionStorage.cart);
      let total = 0;

      for (const product of cart) {
        total += product.price * product.quantity;
      }

      return total;
    },
  },
};
</script>

<style scoped lang="scss">
.cart-card {
  margin-top: 16px;
}
</style>