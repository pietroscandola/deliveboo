<template>
  <div class="container">
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
          <td>{{ product.price }}</td>
          <td>{{ getProductTotalPrice(product) }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>{{ getTotal() }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>
export default {
  name: "Cart",
  data() {
    return {
      cart: JSON.parse(localStorage.cart),
    };
  },
  methods: {
    getProductTotalPrice(product) {
      return product.quantity * product.price;
    },
    getTotal() {
      const cart = JSON.parse(localStorage.cart);
      let total = 0;

      for (const product of cart) {
        total += product.price * product.quantity;
      }

      return total;
    },
  },
};
</script>