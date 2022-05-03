<template>
  <section id="cart" class="container">
    <div class="h1-wrapper d-flex justify-content-between align-items-center">
      <h1>Carrello</h1>
      <a class="go-back-link" role="button" @click="$router.go(-1)"
        >Torna ai prodotti <i class="fa-solid fa-arrow-rotate-left"></i
      ></a>
    </div>
    <table class="table" v-if="cart.length">
      <thead>
        <tr>
          <th scope="col">Nome Prodotto</th>
          <th scope="col">Quantità</th>
          <th scope="col">Prezzo</th>
          <th scope="col">Totale</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in cart" :key="product.id">
          <td scope="row">
            {{ product.name }}
          </td>
          <td>
            {{ product.quantity }}
          </td>
          <td>{{ product.price }} €</td>
          <td>{{ getProductTotalPrice(product) }} €</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td><strong>Totale</strong></td>
          <td>-</td>
          <td>-</td>
          <td>{{ getTotal() }} €</td>
        </tr>
      </tfoot>
    </table>
  </section>
</template>

<script>
export default {
  name: "Cart",
  data() {
    return {
      cart: JSON.parse(sessionStorage.cart),
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
  },
};
</script>

<style lang="scss" scoped>
#cart {
  .h1-wrapper {
    margin-bottom: 15px;
    .go-back-link {
      font-size: 19px;
      &:hover {
        text-decoration: underline;
      }
    }
  }
}
</style>