<template>
   <div class="container-fluid">
      <div>
         <div class="card bg-light">
            <div class="card-header">Payment Information</div>
            <div class="card-body">
               <!-- SUCCESSO -->
               <div class="alert alert-success" v-if="nonce">
                  Successfully generated nonce.
               </div>
               <!-- ERRORE -->
               <div class="alert alert-danger" v-if="error">
                  {{ error }}
               </div>
               <form>
                  <div class="form-group">
                     <label for="amount">Amount</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text">$</span>
                        </div>
                        <input
                           type="number"
                           id="amount"
                           v-model="amount"
                           class="form-control"
                           placeholder="Enter Amount"
                        />
                     </div>
                  </div>
                  <hr />
                  <div class="form-group">
                     <label>Credit Card Number</label>
                     <div id="creditCardNumber" class="form-control"></div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-6">
                           <label>Expire Date</label>
                           <div id="expireDate" class="form-control"></div>
                        </div>
                        <div class="col-6">
                           <label>CVV</label>
                           <div id="cvv" class="form-control"></div>
                        </div>
                     </div>
                  </div>
                  <button
                     class="btn btn-primary btn-block"
                     @click.prevent="payWithCreditCard"
                  >
                     Pay with Credit Card
                  </button>
               </form>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import braintree from "braintree-web";

export default {
   name: "PaymentTwo",
   props: [],
   data() {
      return {
         hostedFieldInstance: false,
         nonce: "",
         error: "",
         amount: 0,
      };
   },
   methods: {
      payWithCreditCard() {
         if (this.hostedFieldInstance) {
            this.error = "";
            this.nonce = "";

            this.hostedFieldInstance
               .tokenize()
               .then((payload) => {
                  console.log(payload);
                  this.nonce = payload.nonce;
               })
               .catch((err) => {
                  console.error(err);
                  this.error = err.message;
               });
         }
      },
   },
   mounted() {
      braintree.client
         .create({
            // Bisogna inserire la key di braintree
            authorization: process.env.VUE_APP_BT_SDK, //se funzionasse :)
         })
         .then((clientInstance) => {
            let options = {
               client: clientInstance,
               styles: {
                  input: {
                     "font-size": "14px",
                     "font-family": "Open Sans",
                  },
               },
               fields: {
                  number: {
                     selector: "#creditCardNumber",
                     placeholder: "Enter Credit Card",
                  },
                  cvv: {
                     selector: "#cvv",
                     placeholder: "Enter CVV",
                  },
                  expirationDate: {
                     selector: "#expireDate",
                     placeholder: "00 / 0000",
                  },
               },
            };
            return braintree.hostedFields.create(options);
         })
         .then((hostedFieldInstance) => {
            // Use hostedFieldInstance to send data to Braintree
            this.hostedFieldInstance = hostedFieldInstance;
         })
         .catch((err) => {});
   },
};
</script>

<style>
</style>