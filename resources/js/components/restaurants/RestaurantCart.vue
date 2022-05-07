<template>
  <div class="cart-card card p-3">
    <!-- Il tuo ordine -->
    <div
      v-if="!isCheckOutPage && !isTrashCartDialogShowed"
      class="div d-flex justify-content-between align-items-center mb-1"
    >
      <h3 class="mb-3">Il tuo ordine</h3>
      <span class="mb-3" role="button" @click="showTrashCartDialog()"
        ><i class="fa-solid fa-trash-can fa-lg"></i
      ></span>
    </div>
    <!-- Dialogo Carrello -->
    <Transition name="slide-fade">
      <div
        v-if="!isCheckOutPage && isTrashCartDialogShowed"
        class="div d-flex justify-content-between align-items-center mb-1"
      >
        <h3 class="mb-3">Svuotare il carrello?</h3>
        <div class="d-flex align-items-center">
          <span
            class="mb-3 mr-3 rounded text-success"
            role="button"
            @click="
              hideTrashCartDialog();
              deleteCart();
            "
            ><i class="fa-solid fa-circle-check fa-lg"></i
          ></span>
          <span
            class="mb-3 rounded text-danger"
            role="button"
            @click="hideTrashCartDialog()"
            ><i class="fa-solid fa-circle-xmark fa-lg"></i
          ></span>
        </div>
      </div>
    </Transition>

    <div v-if="isCheckOutPage">
      <h3 class="cart-h3">Carrello</h3>
    </div>
    <!-- Prodotti -->
    <div class="mb-3">
      <div v-for="product in cart" :key="product.id">
        <div class="product d-flex justify-content-between row mb-1">
          <!-- CheckOut view -->
          <div v-if="isCheckOutPage" class="col-8 d-flex">
            <!-- Product Name -->
            <span
              v-if="isCheckOutPage"
              class="text-muted"
              style="margin-right: 8px"
            >
              {{ product.quantity }}x
            </span>
            <span class="mb-1">{{ product.name }}</span>
          </div>
          <div
            v-if="isCheckOutPage"
            class="col-4 d-flex justify-content-between"
          >
            <!-- Buttons -->
            <div v-if="!isCheckOutPage" class="button-container d-flex">
              <!-- Minus SVG -->
              <svg
                @click="removeFromCart(product.product_id)"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="button"
                focusable="false"
                class="
                  ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049
                  mr-1
                "
              >
                <path
                  d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"
                  fill="#00CCBC"
                ></path>
              </svg>
              <!-- Product Quantity -->
              <span class="mr-1"> {{ product.quantity }} </span>
              <!-- Plus SVG -->
              <svg
                @click="
                  addCart(
                    product.product_id,
                    product.name,
                    product.price,
                    restaurant.id
                  )
                "
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="button"
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
            <!-- place holder for Cart Page -->
            <div></div>
            <!-- Price -->
            <span>{{ getProductTotalPrice(product).toFixed(2) }} €</span>
          </div>
          <!-- RestaurantShow view -->
          <div v-if="!isCheckOutPage" class="col-6 d-flex">
            <!-- Product Name -->
            <span v-if="isCheckOutPage" class="mr-1">
              {{ product.quantity }}x
            </span>
            <span class="mb-1">{{ product.name }}</span>
          </div>
          <div
            v-if="!isCheckOutPage"
            class="col-6 d-flex justify-content-between"
          >
            <!-- Buttons -->
            <div v-if="!isCheckOutPage" class="button-container d-flex">
              <!-- Minus SVG -->
              <svg
                @click="removeFromCart(product.product_id)"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="button"
                focusable="false"
                class="
                  ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049
                  mr-1
                "
              >
                <path
                  d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"
                  fill="#00CCBC"
                ></path>
              </svg>
              <!-- Product Quantity -->
              <span class="mr-1"> {{ product.quantity }} </span>
              <!-- Plus SVG -->
              <svg
                @click="
                  addCart(
                    product.product_id,
                    product.name,
                    product.price,
                    restaurant.id
                  )
                "
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns="http://www.w3.org/2000/svg"
                height="24"
                width="24"
                viewBox="0 0 24 24"
                role="button"
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
            <!-- place holder for Cart Page -->
            <div></div>
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
    <div v-if="!isCheckOutPage" class="mt-3">
      <a class="checkout-button" href="http://127.0.0.1:8000/checkout">
        Vai al pagamento
      </a>
    </div>
    <!-- <Payment :getTotal="getTotal()" /> -->
  </div>
</template>

<script>
// import Payment from "../payment/Payment.vue";

export default {
  name: "RestaurantCart",
  components: {
    // Payment,
  },
  data() {
    return {
      isTrashCartDialogShowed: false,
    };
  },
  props: ["cart", "restaurant", "addCart", "removeFromCart"],
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
    deleteCart() {
      sessionStorage.removeItem("cart");
      // Update Cart
      this.$emit("empty-cart");
    },

    // TrashCartDialog Methods
    showTrashCartDialog() {
      this.isTrashCartDialogShowed = true;
    },
    hideTrashCartDialog() {
      this.isTrashCartDialogShowed = false;
    },
  },
  computed: {
    isCheckOutPage() {
      return this.$route.name === "checkout";
    },
  },
};
</script>

<style scoped lang="scss">
.cart-card {
  .fa-trash-can,
  .fa-circle-xmark {
    color: rgb(255 49 49);
  }

  margin-top: 16px;
  .cart-h3 {
    font-size: 1.5em;
    margin-bottom: 7px;
  }
  h3 {
    font-weight: 900;
  }
  span {
    font-size: 16px;
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

// Animazione Dialogo Carrello
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-enter {
  transform: translateX(20px);
  opacity: 0;
}
</style>