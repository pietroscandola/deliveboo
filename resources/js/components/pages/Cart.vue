<template>
  <section id="cart" class="container py-4">
    <!-- Titolo e back -->
    <div class="row d-flex justify-content-between align-items-center">
      <div
        class="
          col-12 col-md-7
          d-flex
          justify-content-center justify-content-md-start
          text-center text-md-start
        "
      >
        <h1>Controllo il tuo Ordine</h1>
      </div>
      <div
        class="
          col-12 col-md-5
          d-flex
          justify-content-center justify-content-md-end
          mt-md-0 mt-1
        "
      >
        <a
          v-if="isPaid"
          class="go-back-link"
          role="button"
          @click="$router.go(-1)"
          >Modifica il tuo Ordine <i class="fa-solid fa-arrow-rotate-left"></i
        ></a>
        <a v-else class="go-back-link" role="button" @click="$router.go(-1)"
          >Torna alla Home <i class="fa-solid fa-arrow-rotate-left"></i
        ></a>
      </div>
    </div>
    <!-- Pagamento e carrello -->
    <div class="row d-flex flex-lg-row flex-column-reverse">
      <div class="col-12 col-lg-8">
        <Payment
          class="mt-3"
          :tot="getTotal().toFixed(2)"
          :cart="cart"
          @emptyCart="emptyCart"
        />
      </div>
      <div v-if="isPaid" class="col-12 col-lg-4">
        <RestaurantCart v-if="isPaid" class="mb-3" :cart="cart" />
      </div>
    </div>
  </section>
</template>

<script>
import Payment from "../payment/Payment.vue";
import RestaurantCart from "../restaurants/RestaurantCart.vue";
export default {
  name: "Cart",
  components: {
    Payment,
    RestaurantCart,
  },
  data() {
    return {
      cart: JSON.parse(sessionStorage.cart),
      isPaid: true,
    };
  },
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
    emptyCart(newCart) {
      this.cart = newCart;
      // sessionStorage.clear(); // Se decommentato, la sessionStorage viene svuotata ma il componente RestaurantCart rimane visibile
      this.isPaid = false;
    },
  },
  computed: {},
};
</script>

<style lang="scss" scoped>
#cart {
  h1 {
    font-weight: 900;
  }
  .go-back-link {
    font-size: 19px;
    &:hover {
      text-decoration: underline;
    }
  }
}
</style>