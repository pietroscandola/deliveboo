<template>
   <div>
      <div>
         <div class="card bg-light">
            <div class="card-header">Informazioni di Pagamento</div>
            <div class="card-body">
               <!-- SUCCESSO -->
               <div class="alert alert-success" v-if="nonce">
                  Pagamento andato a buon fine
               </div>
               <!-- ERRORE -->
               <div class="alert alert-danger" v-if="error">
                  {{ error }}
               </div>
               <!-- PAGAMENTO -->
               <form>
                  <div class="form-group">
                     <label for="amount">Importo Totale</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text">€</span>
                        </div>
                        <input
                           type="text"
                           id="amount"
                           class="form-control"
                           v-model="amount"
                           disabled
                        />
                     </div>
                  </div>
                  <hr />
                  <div class="form-group">
                     <label>Numero Carta di Credito</label>
                     <div id="creditCardNumber" class="form-control"></div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-6">
                           <label>Data di Scadenza</label>
                           <div id="expireDate" class="form-control"></div>
                        </div>
                        <div class="col-6">
                           <label>CVV</label>
                           <div id="cvv" class="form-control"></div>
                        </div>
                     </div>
                  </div>
                  <button
                     class="payment-button"
                     @click.prevent="payWithCreditCard"
                  >
                     Paga
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
   props: ["tot"],
   data() {
      return {
         hostedFieldInstance: false,
         nonce: "",
         error: "",
         amount: this.tot,
         order: {
            restaurant_id: 2,
            customer_name: "Logi",
            customer_surname: "Tech",
            customer_email: "email@email.com",
            customer_address: "via mare inquinato 5",
            customer_phone: "1591591591",
            amount: this.amount,
            is_delivered: false,
            is_paid: true,
         },
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
                  const params = {
                     restaurant_id: 2,
                     customer_name: "Logi",
                     customer_surname: "Tech",
                     customer_email: "email@email.com",
                     customer_address: "via mare inquinato 5",
                     customer_phone: "1591591591",
                     amount: this.amount,
                     is_delivered: 0,
                     is_paid: 1,
                  };
                  axios
                     .post("http://localhost:8000/api/order", params)
                     .then((res) => {
                        console.log(params);
                        console.log("Axios ok");
                     })
                     .catch((err) => {
                        console.error(err);
                     })
                     .then(() => {
                        console.log("OK API");
                     });
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
            // Aggiungere MIX_VUE_APP_BT_SDK con la propria key
            authorization: process.env.MIX_VUE_APP_BT_SDK,
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
   watch: {
      tot: function (v) {
         this.amount = parseFloat(v.toFixed(2));
      },
   },
};
</script>
<style scoped lang="scss">
.payment-button {
   width: 100%;
   border: none;
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
</style>