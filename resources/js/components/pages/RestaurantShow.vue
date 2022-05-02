<template>
  <div id="restaurant-show" class="container-fluid container-md">
    <!-- Loader visibile fin che la chiamata axios non finisce -->
    <Loader v-if="isLoading" />
    <div v-else class="row">
      <!-- RISTORANTE -->
      <div class="col-12">
        <div class="card">
          <!-- Header con nome e categorie -->
          <div class="card-header d-flex justify-content-between">
            <h5 class="m-0">{{ restaurant.name }}</h5>
            <div v-if="restaurant.categories" class="categories-box">
              <span
                v-for="category in restaurant.categories"
                :key="category.id"
                class="badge badge-primary mx-1"
              >
                {{ category.name }}
              </span>
            </div>
          </div>
          <!-- Immagine e descrizione ristorante -->
          <div class="card-body row">
            <div class="col-sm-12 col-md-4">
              <img
                class="img-fluid"
                src="https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"
                alt="R"
              />
            </div>
            <div class="col-sm-12 col-md-8">
              <h5 class="card-title">{{ restaurant.address }}</h5>
              <p class="card-text">
                {{ restaurant.description }}
              </p>
              <button class="btn btn-primary" @click="$router.back()">
                Indietro
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- PRODOTTI -->
      <div class="col-12 mt-3">
        <h2>Prodotti</h2>
      </div>
      <div
        v-for="product in products"
        :key="product.id"
        class="col-sm-6 col-lg-3"
      >
        <div class="card my-3">
          <img
            v-if="product.image"
            class="card-img-top"
            :src="'/storage/' + product.image"
            alt="Card image cap"
          />
          <div class="card-body">
            <h5>{{ product.name }}, {{ product.id }}</h5>
            <p class="card-text">REE</p>
            <button @click="removeFromCart(product.id)">Rimuovi</button>
            <button @click="addCart(product.id)">Aggiungi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from "../Loader.vue";

export default {
  name: "RestaurantShow",
  components: {
    Loader,
  },
  data() {
    return {
      isLoading: false,
      restaurant: {},
      products: [],
      cart: [],
    };
  },
  methods: {
    getRestaurant() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/restaurants/" + this.$route.params.id)
        .then((res) => {
          const { products, ...restaurant } = res.data;
          this.products = products;
          this.restaurant = restaurant;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
          console.log("OK API");
        });
    },

    addCart(id) {
      // this.cart.push({ prod_id: id, unitprice: "helo", code: "helo" }); // what to push unto the rows array?
      const can = {
        prod_id: id,
        quantity: 1,
      };
      let already_in = false;

      if (this.cart.length === 0) {
        this.cart.push(can);
        already_in = true;
        console.log(this.cart, "NEW FROM EMPTY");
      } else {
        this.cart.forEach((product) => {
          if (product["prod_id"] === id) {
            product.quantity++;
            already_in = true;
            console.log(this.cart, "QUANTITY");
          }
        });
      }
      if (!already_in) {
        this.cart.push(can);
        console.log(this.cart, "NEW");
      }
      // console.log(id);
    },

    removeFromCart(id) {
      if (this.cart.length === 0) {
        console.log("EMPTY CART");
      } else {
        this.cart.forEach((product) => {
          if (product["prod_id"] === id && product["quantity"] != 1) {
            product.quantity--;
            console.log(this.cart, "LESS QUANTITY");
          } else if (product["prod_id"] === id) {
            const i = this.cart.findIndex((object) => {
              return object.prod_id === id;
            });
            this.cart.splice(i, 1);
            console.log(this.cart, "REMOVED");
          }
        });
      }
    },
  },
  mounted() {
    this.getRestaurant();

    // SessionStorageCart
    if (sessionStorage.cart) {
      this.cart = JSON.parse(sessionStorage.cart);
    }
  },
  watch: {
    cart: {
      handler(newCart) {
        sessionStorage.cart = JSON.stringify(newCart);
      },
      deep: true,
    },
  },
};
</script>

<style>
</style>