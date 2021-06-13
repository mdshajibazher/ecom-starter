<template>
  <div class="single-product shop-quick-view-ajax">
    <div class="product modal-padding">
      <h3 class="text-center text-bold">{{ productDetails.title }}</h3>
      <hr />


      <div v-if="LoginMode == false && RegisterMode == false">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <div class="form-group mt-3">
                <h4>Select Color</h4>
                <div class="c-color-swatch">
                  <div v-for="color in productDetails.colors" :key="color.id">
                    <input
                      v-model="productColor"
                      type="radio"
                      name="color"
                      :value="color.id"
                      :id="'color-' + color.color_code"
                      hidden
                    />
                    <label
                      class="c-color-swatch__item"
                      :for="'color-' + color.color_code"
                      :style="{ background: color.color_code }"
                      >{{ color.title }}</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <div class="form-group mt-3">
                <h4>Select Size</h4>
                <div class="c-size-swatch">
                  <div v-for="size in productDetails.sizes" :key="size.id">
                    <input
                      v-model="productSize"
                      type="radio"
                      name="size"
                      :value="size.id"
                      :id="'size-' + size.title"
                      hidden
                    />
                    <label
                      class="c-size-swatch__item"
                      :for="'size-' + size.title"
                      >{{ size.title }}</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-if="selectedProduct">
          <div class="col-6">
            <img
              width="100%"
              :src="'/images/products/variant/resized/' + selectedProduct.image"
              :alt="selectedProduct.size.title"
            />
          </div>
          <div class="col-6">
            <h3 class="text-danger mb-3">
              <b>{{ selectedProduct.price }} BDT</b>
            </h3>
			
            <button
              :disabled="!selectedProduct || selectedProduct.stock < 1"
              @click="addToCart(productDetails, selectedProduct)"
              :class="{ loading: buttonLoader == selectedProduct.id }"
              type="submit"
              class="atc"
            >
              <i class="icon-shopping-basket"></i> Add To Cart
            </button>
			<p v-if="selectedProduct.stock < 1" class="alert alert-danger mt-3">out of stock</p>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div v-if="Object.keys(this.userData).length > 0">
          <p class="alert alert-success">
            Thank you mr "<b>{{ userData.name }}</b
            >".you are now logged in & you can now order product
          </p>
          <h4>Login details for future login</h4>
          <table class="table table-bordered">
            <tr>
              <td>Email:</td>
              <th>{{ userData.email }}</th>
            </tr>
            <tr>
              <td>Password</td>
              <th>**********</th>
            </tr>
          </table>
        </div>
        <register-component
          @userResponse="userResponse"
          @moveloginMode="moveloginMode"
          v-if="RegisterMode"
        />
        <login-component
          @userDataFromServer="userDataFromServer"
          @moveRegisterMode="moveRegisterMode"
          v-if="LoginMode"
        />
      </div>

      <div class="card product-meta mb-0">
        <div class="card-body">
          <span class="sku_wrapper"
            >SKU: <span class="sku">{{ productDetails.sku }}</span></span
          >
          <span class="posted_in"
            >Tags:
            <a
              v-for="(sub, index) in productDetails.subcollections"
              :key="index"
              href="#"
              rel="tag"
              >{{ sub.title }}</a
            >,</span
          >
          <span class="tagged_as"
            >Collection: <a href="#" rel="tag">{{ collection.title }}</a>
          </span>
          <span class="sku_wrapper"
            >Description: <span>{{ productDetails.description }}</span></span
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginComponent from "./LoginComponent";
import RegisterComponent from "./RegisterComponet";
export default {
  mounted() {
    this.$root.$on("PRODUCT_ID_EVENT_BUS", (id) => {
      axios
        .get("/product_details/" + id)
        .then(({ data }) => {
          this.userData = {};
          this.productDetails = data.products;
          this.collection = data.products.collection;
          this.PricesAndStockData = data.products.prices;
          this.is_logged_in = data.is_logged_in;
          (this.LoginMode = false),
          (this.RegisterMode = false),
			//set initila data 

		   this.productColor = this.productDetails.prices[0].color_id;
		   this.productSize = this.productDetails.prices[0].size_id;


            $("#productModal").modal("show");
        })
        .catch((e) => {
          e.response.data.message;
        });
    });
  },

  data() {
    return {
      productDetails: [],
      collection: "",
      userData: {},
      PricesAndStockData: [],
      is_logged_in: false,
      LoginMode: false,
      RegisterMode: false,
      buttonLoader: "",
      productColor: "",
      productSize: "",
      productImage: "",
    };
  },
  props: ["postTitle"],
  components: {
    RegisterComponent,
    LoginComponent,
  },
  computed: {
    selectedProduct: function () {
      if (this.productColor && this.productSize) {
        return this.productDetails.prices.find((price_stock_info) => {
          return (
            price_stock_info.color_id == this.productColor &&
            price_stock_info.size_id == this.productSize
          );
        });
      }
      return "";
    },
  },
  methods: {
    addToCart(product, product_variant_combination) {
      this.buttonLoader = product_variant_combination.id;
      axios
        .get("/is_logged_in")
        .then(({ data }) => {
          if (data == true) {
            this.buttonLoader = "";
            this.$store.dispatch("addProductToCart", {
              product,
              qty: 1,
              product_variant_combination,
            });
            // this.buttonLoader = false;
          } else {
            this.RegisterMode = true;
            this.buttonLoader = "";
            iziToast.warning({
              title: "Warning",
              position: "topRight",
              message: "Please register/login before order",
            });
          }
        })
        .catch((e) => {
          this.buttonLoader = "";
          iziToast.error({
            title: "Error",
            position: "topRight",
            message: e.response.data.message,
          });
        });
    },
    moveloginMode() {
      this.RegisterMode = false;
      this.LoginMode = true;
    },
    moveRegisterMode() {
      this.LoginMode = false;
      this.RegisterMode = true;
    },
    userDataFromServer(data) {
      this.userData = data;
      this.LoginMode = false;
      this.RegisterMode = false;
      this.is_logged_in = true;
    },

    userResponse(data) {
      this.userData = data;
      this.LoginMode = false;
      this.RegisterMode = false;
      this.is_logged_in = true;
    },
    getInStock(stock) {
      if (stock > 0) {
        return "<p class='badge badge-warning'>Available</p>";
      }
      return "<p class='badge badge-danger'>Out of stock</p>";
    },
  },
};
</script>

<style scoped>
.atc {
  display: inline-block;
  border: 0;
  outline: 0;
  padding: 3px 10px;
  line-height: 1.4;
  background: linear-gradient(#44bc9c, #079992);
  border-radius: 5px;
  font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
  color: white !important;
  font-size: 1.2em;
  cursor: pointer;
  /* Important part */
  position: relative;
  transition: padding-right 0.3s ease-out;
}
.atc:disabled {
  background: #ccc !important;
}
.atc.loading {
  background-color: #ccc;
  padding-right: 40px;
}
.atc.loading:after {
  content: "";
  position: absolute;
  border-radius: 100%;
  right: 6px;
  top: 50%;
  width: 0px;
  height: 0px;
  margin-top: -2px;
  border: 4px solid rgba(255, 255, 255, 0.5);
  border-left-color: #fff;
  border-top-color: #fff;
  animation: spin 0.6s infinite linear, grow 0.3s forwards ease-out;
}
@keyframes spin {
  to {
    transform: rotate(359deg);
  }
}
@keyframes grow {
  to {
    width: 16px;
    height: 16px;
    margin-top: -8px;
    right: 13px;
  }
}

/* color switch */

.c-color-swatch__item {
  width: auto;
  text-align: center;
  user-select: none;
  position: relative;
  transition: transform 0.25s;
  color: #fff;
  /* width:  28px;
	height: 28px; */
  border-radius: 100%;
  padding: 5px 10px;
  border-radius: 4px;
  display: block;
  margin-right: 5px;
}

.c-color-swatch__item:hover {
  z-index: 1;
  transform: scale(1.1);
}
.c-color-swatch [type="radio"]:checked + .c-color-swatch__item {
  background: #fff;
  border: 2px solid #ddd !important;
}
.c-color-swatch [type="radio"]:checked + label:after {
  content: "selected";
  width: 10px;
  height: 10px;
  padding: 2px 4px;
  background: #000;
  border-radius: 5px;
  margin-left: 7px;
  font-size: 9px;
}
/* size swatch */
.c-size-swatch__item {
  width: auto;
  text-align: center;
  user-select: none;
  transition: transform 0.25s;
  color: #000;
  /* width:  28px;
	height: 28px; */
  border-radius: 100%;
  padding: 5px 10px;
  border-radius: 4px;
  display: inline-block;
  margin-right: 5px;
  border: 1px solid #000;
}

.c-size-swatch [type="radio"]:checked + .c-size-swatch__item {
  background: #000;
  color: #fff;
  border-radius: 5px;
}
</style>