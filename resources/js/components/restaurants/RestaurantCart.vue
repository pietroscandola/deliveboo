<template>
  <table class="table">
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
        <!-- <td>{{ getProductTotalPrice(product).toFixed(2) }} €</td> -->
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td><strong>Totale</strong></td>
        <td>-</td>
        <td>-</td>
        <!-- <td>{{ getTotal().toFixed(2) }} €</td> -->
      </tr>
    </tfoot>
  </table>
</template>

<script>
export default {
  name: "RestaurantCart",
  props: ["cart"],
};
</script>

<style>
</style>