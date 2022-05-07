<template>
  <div>
    <!-- Img Smartphone-->
    <div class="mb-0 d-block d-sm-none">
      <img
        style="max-width: 100%"
        src="https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"
        alt=""
      />
    </div>
    <div id="restaurant-show" class="container-fluid pb-5">
      <!-- Loader visibile fin che la chiamata axios non finisce -->
      <Loader v-if="isLoading" />
      <div id="restaurant-info" v-else class="row bg-white pb-3 shadow-sm mb-3">
        <!-- RISTORANTE -->
        <div class="col-12 mb-3">
          <div class="container-fluid container-md">
            <div class="row">
              <!-- Img -->
              <div
                id="restaurant-image"
                class="col-12 col-sm-4 mb-3 mb-sm-0 d-none d-sm-block"
              >
                <img
                  src="https://www.labracefoodexperience.it/wp-content/uploads/2021/02/Hamburgers-01-La-Barce-Food-Experience.jpg"
                  alt=""
                />
              </div>
              <div class="col-12 col-sm-8">
                <!-- Name -->
                <div
                  id="restaurant-name"
                  class="d-flex justify-content-between align-items-center row"
                >
                  <div
                    class="
                      col-12 col-lg-9 col-md-11 col-sm-12
                      text-center text-sm-left
                    "
                  >
                    <h1>{{ restaurant.name }}</h1>
                  </div>
                  <!-- Back Button -->
                  <div
                    class="
                      col-3 col-lg-3 col-md-1 col-sm-0
                      d-flex
                      justify-content-start justify-content-md-end
                      back-button-wrapper
                    "
                  >
                    <router-link
                      :to="{ name: 'home' }"
                      class="d-flex align-items-center"
                    >
                      <i
                        class="
                          fa-solid fa-chevron-left fa-lg
                          mr-1
                          d-none d-md-inline
                        "
                      ></i
                      ><span
                        class="d-lg-inline d-none"
                        style="line-height: 24px"
                        >Indietro</span
                      >
                    </router-link>
                  </div>
                </div>
                <!-- Categories -->
                <div
                  class="
                    categories-container
                    mb-4 mb-sm-3
                    text-center text-sm-left
                  "
                >
                  <span
                    class="mr-1 badge badge-danger"
                    v-for="category in restaurant.categories"
                    :key="category.id"
                  >
                    {{ category.name }}
                  </span>
                </div>
                <div class="d-flex justify-content-between flex-column">
                  <!-- Description -->
                  <p class="text-muted text-justify text-sm-left">
                    {{ restaurant.description }}
                  </p>
                  <!-- Contacts -->
                  <div class="contacts-wrapper mt-3 text-center text-sm-left">
                    <span class="mr-3 mb-3 d-lg-inline d-block"
                      ><i class="fa-solid fa-location-dot fa-lg"></i
                      >{{ restaurant.address }}</span
                    >
                    <span
                      ><i class="fa-solid fa-phone fa-lg"></i
                      >{{ restaurant.phone }}</span
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div
          class="modal fade"
          id="modale"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Vuoi creare un nuovo carrello?
                </h5>
                <svg
                  data-bs-dismiss="modal"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  xmlns="http://www.w3.org/2000/svg"
                  height="24"
                  width="24"
                  viewBox="0 0 24 24"
                  role="button"
                  focusable="false"
                  class="
                    close-button
                    ccl-0f24ac4b87ce1f67
                    ccl-abe5c41af1b9498e
                    ccl-c738ab1fde928049
                  "
                >
                  <path
                    d="M12.0001 10.2322L5.88398 4.11612L4.11621 5.88389L10.2323 12L4.11621 18.1161L5.88398 19.8839L12.0001 13.7678L18.1162 19.8839L19.884 18.1161L13.7679 12L19.884 5.88389L18.1162 4.11612L12.0001 10.2322Z"
                    fill="#00CCBC"
                  ></path>
                </svg>
              </div>
              <div class="modal-body">
                <h6>
                  Nel carrello sono presenti prodotti di un altro ristorante,
                  sei sicuro di volerli eliminare e creare un nuovo carrello?
                </h6>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="cancel-button"
                  data-bs-dismiss="modal"
                >
                  Annulla
                </button>
                <button
                  type="button"
                  class="confirm-button"
                  data-bs-dismiss="modal"
                  @click="
                    getEmptyCart(
                      currentProduct.id,
                      currentProduct.name,
                      currentProduct.price,
                      restaurant.id
                    )
                  "
                >
                  Nuovo Carrello
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- PRODOTTI E CARRELLO -->
      <div class="container">
        <div class="row d-flex flex-lg-row flex-column">
          <!-- LISTA PRODOTTI -->
          <div class="col-12 col-lg-8">
            <!-- Cards -->
            <div class="row">
              <div
                v-for="product in products"
                :key="product.id"
                class="col-sm-6 col-lg-4"
              >
                <div class="card product-card my-3">
                  <img
                    height="150"
                    v-if="product.image"
                    class="card-img-top"
                    :src="'/storage/' + product.image"
                    alt="Card image cap"
                  />
                  <div
                    class="card-body justify-content-between d-flex flex-column"
                  >
                    <div>
                      <h5>
                        <strong>{{ product.name }}</strong>
                      </h5>
                      <p class="card-text">{{ product.ingredients }}</p>
                      <!-- Price badge -->
                      <span class="badge badge-warning price-badge">
                        <strong>{{ product.price.toFixed(2) }} €</strong>
                      </span>
                    </div>
                    <div
                      class="d-flex justify-content-around align-items-center"
                    >
                      <!-- Minus SVG -->
                      <svg
                        @click="removeFromCart(product.id)"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns="http://www.w3.org/2000/svg"
                        height="24"
                        width="24"
                        viewBox="0 0 24 24"
                        role="button"
                        focusable="false"
                        class="
                          ccl-0f24ac4b87ce1f67
                          ccl-ed34b65f78f16205
                          ccl-c738ab1fde928049
                        "
                      >
                        <path
                          d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"
                          fill="#00CCBC"
                        ></path>
                      </svg>
                      <div>
                        <p class="m-0">{{ getIncrement(product.id) }}</p>
                        <!-- da inserire la quantità incrementata -->
                      </div>
                      <!-- Fake Plus -->
                      <svg
                        @click="getCurrentProduct(product)"
                        v-if="
                          currentRestaurant !== restaurant.id &&
                          currentRestaurant !== 0
                        "
                        data-bs-toggle="modal"
                        data-bs-target="#modale"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns="http://www.w3.org/2000/svg"
                        height="24"
                        width="24"
                        viewBox="0 0 24 24"
                        role="button"
                        focusable="false"
                        class="
                          ccl-0f24ac4b87ce1f67
                          ccl-ed34b65f78f16205
                          ccl-c738ab1fde928049
                        "
                      >
                        <path
                          d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"
                          fill="#00CCBC"
                        ></path>
                      </svg>
                      <!-- Plus SVG -->
                      <svg
                        v-else
                        @click="
                          addCart(
                            product.id,
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
                          ccl-0f24ac4b87ce1f67
                          ccl-ed34b65f78f16205
                          ccl-c738ab1fde928049
                        "
                      >
                        <path
                          d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"
                          fill="#00CCBC"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- CARRELLO -->
          <div class="col-12 col-lg-4">
            <RestaurantCart
              v-if="cart.length && currentRestaurant === restaurant.id"
              :addCart="addCart"
              :removeFromCart="removeFromCart"
              :restaurant="restaurant"
              :cart="cart"
              @empty-cart="emptyCart"
            />
            <!-- Empty Cart -->
            <div
              v-else
              class="
                empty-cart
                d-flex
                justify-content-center
                flex-column
                align-items-center
              "
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32px"
                height="32px"
                fill="currentColor"
                class="bi bi-basket my-3"
                viewBox="0 0 16 16"
              >
                <path
                  d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"
                />
              </svg>
              <h3>Il carrello è vuoto</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from "../Loader.vue";
import RestaurantCart from "../restaurants/RestaurantCart.vue";
export default {
  name: "RestaurantShow",
  components: {
    Loader,
    RestaurantCart,
  },
  data() {
    return {
      isLoading: false,
      restaurant: [],
      products: [],
      cart: [],
      currentRestaurant: 0,
      currentProduct: [],
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
    addCart(id, name, price, restaurant_id) {
      console.log("prova");
      // this.cart.push({ product_id: id, unitprice: "helo", code: "helo" }); // what to push unto the rows array?
      const can = {
        product_id: id,
        name,
        price,
        quantity: 1,
      };
      let already_in = false;
      if (restaurant_id !== this.currentRestaurant) {
        this.cart = [];
        this.currentRestaurant = restaurant_id;
      } else {
        this.currentRestaurant = restaurant_id;
      }
      if (this.cart.length === 0) {
        this.cart.push(can);
        already_in = true;
        console.log(this.cart, "NEW FROM EMPTY");
      } else {
        this.cart.forEach((product) => {
          if (product["product_id"] === id) {
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
      this.currentProduct = this.cart;
      // console.log(id);
    },
    removeFromCart(id) {
      console.log();
      if (this.cart.length === 0) {
        console.log("EMPTY CART");
      } else {
        this.cart.forEach((product) => {
          if (product["product_id"] === id && product["quantity"] != 1) {
            product.quantity--;
            console.log(this.cart, "LESS QUANTITY");
          } else if (product["product_id"] === id) {
            const i = this.cart.findIndex((object) => {
              return object.product_id === id;
            });
            this.cart.splice(i, 1);
            console.log(this.cart, "REMOVED");
          }
        });
      }
      if (this.cart.length < 1) {
        this.currentRestaurant = 0;
      }
    },
    getProductTotalPrice(product) {
      return product.quantity * product.price;
    },
    getIncrement(id) {
      let total = 0;
      const can = {
        product_id: id,
      };
      this.cart.forEach((product) => {
        if (product["product_id"] === id) {
          total += product.quantity;
        }
      });
      return total;
    },
    // Cart deleting from children RestaurantCart through $emit
    emptyCart() {
      this.cart = [];

      this.currentRestaurant = 0;
    },

    getEmptyCart(id, name, price, restaurant_id) {
      this.cart = [];
      this.currentRestaurant = restaurant_id;
      const can = {
        product_id: id,
        name,
        price,
        quantity: 1,
      };
      this.cart.push(can);
    },

    getCurrentProduct(product) {
      this.currentProduct = product;
    },
  },

  mounted() {
    this.getRestaurant();
    // SessionStorageCart - Restaurant (NUOVO)
    if (sessionStorage.currentRestaurant) {
      this.currentRestaurant = JSON.parse(sessionStorage.currentRestaurant);
    }
    // SessionStorageCart - Cart (VECCHIO)
    if (sessionStorage.cart) {
      this.cart = JSON.parse(sessionStorage.cart);
    }
  },
  watch: {
    currentRestaurant: {
      handler(newCurrentRestaurant) {
        sessionStorage.currentRestaurant = JSON.stringify(newCurrentRestaurant);
      },
      deep: true,
    },
    cart: {
      handler(newCart) {
        sessionStorage.cart = JSON.stringify(newCart);
      },
      deep: true,
    },
  },
  computed: {
    getTotalQuantity() {
      let total = 0;
      this.cart.forEach((product) => {
        total += product.quantity;
      });
      return total;
    },
  },
};
</script>

<style scoped lang="scss">
#restaurant-info {
  padding-top: 30px;
  #restaurant-image {
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px;
    }
  }
  #restaurant-name {
    h1 {
      font-weight: 900;
      margin-bottom: 0px;
    }
    .back-button-wrapper {
      a {
        &:hover {
          text-decoration: none;
        }
        span {
          line-height: 24px;
        }
      }
    }
  }
  .categories-container {
    margin-bottom: 15px;
  }
  .contacts-wrapper {
    i {
      color: #00ccbc;
      margin-right: 10px;
    }
  }
}

// PRODOTTI
.product-card {
  min-height: 95%;
  position: relative;
  .price-badge {
    position: absolute;
    box-shadow: 0 0 6px rgba(107, 107, 107, 1);
    top: 10px;
    right: 10px;
  }
}
.empty-cart {
  height: 150px;
  margin-top: 15px;
  color: rgb(138, 138, 138);
  background-color: #fff;
  border: 1px solid #e2e5e5;
  border-radius: 5px;
}

// MODALE
.modal {
  .modal-content {
    padding-left: 5px;
    padding-right: 5px;
    .modal-header {
      border-bottom: none;
      .modal-title {
        font-weight: 900;
        font-size: 19px;
      }
    }
    .modal-body {
      h6 {
        font-size: 16px;
      }
    }
    .modal-footer {
      border-top: none;
    }
    .close-button {
      border-radius: 3px;
      &:active {
        box-shadow: 0 0 0 3px rgba(0, 204, 188, 0.3);
      }
    }
    .cancel-button {
      display: block;
      text-align: center;
      background-color: #fff;
      color: #00ccbc;
      border: 1px solid #e8ebeb;
      border-radius: 5px;
      padding: 10px;
      &:focus {
        box-shadow: 0 0 0 3px rgba(0, 204, 188, 0.3);
      }
      &:hover {
        border: 1px solid #d1d4d4;
        text-decoration: none;
      }
    }
    .confirm-button {
      display: block;
      text-align: center;
      background-color: #00ccbc;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-weight: 900;
      padding: 10px;
      &:focus {
        box-shadow: 0 0 0 3px rgba(0, 204, 188, 0.3);
      }
      &:hover {
        background-color: #00c2b3;
        text-decoration: none;
      }
    }
  }
}
</style>