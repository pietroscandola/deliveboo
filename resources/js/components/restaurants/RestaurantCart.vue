<template>
   <div>
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
                  <small>
                     {{ product.name }}
                  </small>
               </td>
               <td>
                  <small>
                     {{ product.quantity }}
                  </small>
               </td>
               <td>
                  <small>{{ product.price }} € </small>
               </td>
               <td>
                  <small>
                     {{ getProductTotalPrice(product).toFixed(2) }} €
                  </small>
               </td>
            </tr>
         </tbody>
         <tfoot>
            <tr>
               <td><strong>Totale</strong></td>
               <td>-</td>
               <td>-</td>
               <td>
                  <small> {{ getTotal().toFixed(2) }} € </small>
               </td>
            </tr>
         </tfoot>
      </table>
      <Payment />
   </div>
</template>

<script>
import Payment from "../payment/Payment.vue";

export default {
   name: "RestaurantCart",
   components: {
      Payment,
   },
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

<style>
</style>