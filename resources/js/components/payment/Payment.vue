<template>
  <div class="payment">
    <Loader v-if="isLoading" />
    <div v-if="!isPaid">
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
          <!-- Payment and customer info -->
          <form>
            <!-- Customer info -->
            <div class="form-group">
              <div class="row">
                <!-- Name -->
                <div class="col-6">
                  <label for="customer_name">Nome</label>
                  <div class="input-group">
                    <input
                      type="text"
                      id="customer_name"
                      class="form-control"
                      v-model="order.customer_name"
                    />
                  </div>
                </div>
                <!-- Surname -->
                <div class="col-6">
                  <label for="customer_surname">Cognome</label>
                  <div class="input-group">
                    <input
                      type="text"
                      id="customer_surname"
                      class="form-control"
                      v-model="order.customer_surname"
                    />
                  </div>
                </div>
                <!-- Email -->
                <div class="col-6">
                  <label for="customer_email">Email</label>
                  <div class="input-group">
                    <input
                      type="text"
                      id="customer_email"
                      class="form-control"
                      v-model="order.customer_email"
                    />
                  </div>
                </div>
                <!-- Phone -->
                <div class="col-6">
                  <label for="customer_phone">Numero di telefono</label>
                  <div class="input-group">
                    <input
                      type="tel"
                      id="customer_phone"
                      class="form-control"
                      v-model="order.customer_phone"
                    />
                  </div>
                </div>
                <!-- Address -->
                <div class="col-12">
                  <label for="customer_address">Indirizzo</label>
                  <div class="input-group">
                    <input
                      type="text"
                      id="customer_address"
                      class="form-control"
                      v-model="order.customer_address"
                    />
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <!-- Payment -->
            <div class="form-group">
              <div class="row">
                <!-- Total to pay -->
                <div class="col-3">
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
                <!-- Credit card number -->
                <div class="col-9">
                  <label>Numero Carta di Credito</label>
                  <div id="creditCardNumber" class="form-control"></div>
                </div>
                <!-- Expiration date -->
                <div class="col-6">
                  <label>Data di Scadenza</label>
                  <div id="expireDate" class="form-control"></div>
                </div>
                <!-- CVV -->
                <div class="col-6">
                  <label>CVV</label>
                  <div id="cvv" class="form-control"></div>
                </div>
              </div>
            </div>
            <button class="payment-button" @click.prevent="payWithCreditCard">
              Paga
            </button>
          </form>
        </div>
      </div>
    </div>
    <div v-if="isPaid" class="row ringraziamenti-container">
      <div class="col-12">
        <h3>Il tuo ordine arriverà a breve</h3>

        <h2>
          Hai pagato un totale di <strong>{{ amount }}€</strong>
        </h2>
      </div>
      <div class="col-12" style="height: 300px">
        <Delivering />
      </div>
      <div class="w-100">
        <router-link class="go-home-button d-block mt-3" :to="{ name: 'home' }"
          >Torna alla Home
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import braintree from "braintree-web";
import Loader from "../Loader.vue";
import Delivering from "../animation/Delivering.vue";

export default {
  name: "PaymentTwo",
  components: {
    Loader,
    Delivering,
  },
  props: ["tot", "cart"],
  data() {
    return {
      isLoading: false,
      isPaid: false,
      hostedFieldInstance: false,
      nonce: "",
      error: "",
      amount: this.tot,
      order: {
        restaurant_id: this.$route.params.id,
        customer_name: "Logi",
        customer_surname: "Tech",
        customer_email: "email@email.com",
        customer_address: "via mare inquinato 5",
        customer_phone: "1591591591",
        amount: this.tot,
        is_delivered: 0,
        is_paid: 1,
        products_ids: {},
      },
    };
  },
  methods: {
    payWithCreditCard() {
      if (this.hostedFieldInstance) {
        this.isLoading = true;
        this.error = "";
        this.nonce = "";
        this.hostedFieldInstance
          .tokenize()
          .then((payload) => {
            console.log(payload);
            this.nonce = payload.nonce;
            const params = this.order;
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
                console.log("OK APIII");
                this.isLoading = false;
                this.isPaid = true;
                this.$emit("emptyCart", []);
              });
          })
          .catch((err) => {
            this.isLoading = false;
            console.error(err);
            this.error = err.message;
          });
      }
    },

    getProdIds() {
      const prod = this.cart.map((p) => {
        const container = {};
        container["product_id"] = p.product_id;
        container["quantity"] = p.quantity;
        return container;
      });

      this.order.products_ids = prod;
    },

    getRestaurantIds() {
      this.order.restaurant_id = this.$route.params.id;
    },
  },
  mounted() {
    this.getProdIds();
    this.getRestaurantIds();

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
.go-home-button {
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
.ringraziamenti-container {
  backdrop-filter: blur(32px);
  border-radius: 15px;
  background-color: #fff;
  padding: 30px 30px;
  border: 1px solid #ededed;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
  h2 {
    text-align: center;
    margin-bottom: 30px;
  }
  h3 {
    text-align: center;
  }
}
.payment {
  position: relative;
  .absolute {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
  }
}

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