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
              <!-- Minus SVG -->
              <svg
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="presentation"
                focusable="false"
                class="
                  ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049
                "
              >
                <path
                  d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"
                  fill="#00CCBC"
                ></path>
              </svg>
              <!-- Product Quantity -->
              <span> {{ product.quantity }} </span>
              <!-- Plus SVG -->
              <svg
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="presentation"
                focusable="false"
                class="
                  ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049
                "
              >
                <path
                  d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"
                  fill="#00CCBC"
                ></path>
              </svg>
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
    <div class="mt-3">
      <a class="checkout-button" href="http://127.0.0.1:8000/cart">
        Vai al pagamento
      </a>
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
  h3 {
    font-weight: 900;
  }
  .checkout-button {
    display: block;
    text-align: center;
    background-color: #00ccbc;
    color: #fff;
    border-radius: 5px;
    font-weight: 900;
    padding-top: 10px;
    padding-bottom: 10px;
    &:focus {
      box-shadow: 0 0 0 3px rgba(0, 204, 188, 0.3);
    }
    &:hover {
      background-color: #00c2b3;
      text-decoration: none;
    }
  }
}
</style>