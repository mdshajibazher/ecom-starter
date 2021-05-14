<template>
  			<div class="single-product shop-quick-view-ajax">
				<div class="product modal-padding">
							<h3 class="text-center">{{productDetails.title}}</h3>
						
							<div class="d-flex justify-content-center">
								<img v-for="(image,index) in productDetails.images" :key="index" style="width: 25%;margin-right: 10px" class="img-thumbnail" :src="'/images/products/thumb/'+image.file_path" alt="Pink Printed Dress">
							</div>
					
							<div class="pd-variation" v-if="LoginMode == false && RegisterMode == false">
								<h4 class="text-center"> <span class="product-price">  {{PricesAndStockData.length}}</span> Variation found</h4>
								<table class="table">
									<tr v-for="(price,index) in PricesAndStockData" :key="index">
										<td class="align-middle">
										<table class="table table-borderless table-sm">
											<tr>
												<td>Variation: </td>
												<td>
													<table class="table table-bordered table-sm table-light">
														<tr v-if="price.variant_one!=null">
															<th>{{price.variant_one.variant_label.title}} : </th>
															<td> {{price.variant_one.variant.toUpperCase()}}</td>
														</tr>

														<tr v-if="price.variant_two!=null">
															<th>{{price.variant_two.variant_label.title}} : </th>
															<td>{{price.variant_two.variant.toUpperCase()}}</td>
														</tr>

														<tr v-if="price.variant_three!=null">
															<th>{{price.variant_three.variant_label.title}} : </th>
															<td>{{price.variant_three.variant.toUpperCase()}}</td>
														</tr>
													</table>
                                                </td>
											</tr>
											<tr>
												<td>Price: </td>
												<td><div class="product-price"><ins>{{ price.price }}</ins></div></td>
											</tr>
											<tr>
												<td>Stock</td>
												<td v-html="getInStock(price.stock)"></td>
											</tr>
											<tr v-if="price.stock >0">
												<td>Action</td>
												<td><button @click="addToCart(productDetails,price)" :class="{ loading: buttonLoader ==  price.id}" type="submit" class="atc"><i class="icon-shopping-basket"></i> Add To Cart</button></td>
											</tr>
										</table>
										</td>
								
						
									</tr>
								</table>
							</div>
							<div class="form-group">
								<div v-if="Object.keys(this.userData).length> 0">
									<p class="alert alert-success">Thank you mr "<b>{{userData.name}}</b>".you are now logged in & you can now order product</p>
									<h4>Login details for future login</h4>
									<table class="table table-bordered">
										<tr>
											<td>Email: </td>
											<th>{{userData.email}}</th>
										</tr>
										<tr>
											<td>Password</td>
											<th>**********</th>
										</tr>
									</table>
								</div>
								<register-component @userResponse="userResponse" @moveloginMode="moveloginMode" v-if="RegisterMode"/>
								<login-component @userDataFromServer="userDataFromServer" @moveRegisterMode="moveRegisterMode" v-if="LoginMode"/>
							</div>
							
							<div class="card product-meta mb-0">
								<div class="card-body">
									<span  class="sku_wrapper">SKU: <span class="sku">{{productDetails.sku}}</span></span>
									<span class="posted_in">Tags: <a v-for="(sub,index) in productDetails.subcollections" :key="index" href="#" rel="tag">{{sub.title}}</a>,</span>
									<span class="tagged_as">Collection: <a href="#" rel="tag">{{collection.title}}</a> </span>
									<span class="sku_wrapper">Description: <span>{{productDetails.description}}</span></span>
								</div>
							</div>
				</div>
			</div> 
</template>

<script>
import LoginComponent from './LoginComponent';
import RegisterComponent from './RegisterComponet';
export default {
	mounted(){
		this.$root.$on('PRODUCT_ID_EVENT_BUS',(id) => {
			axios.get('/product_details/'+id)
			.then(({data}) => {
				this.userData = {};
				this.productDetails = data.products;
				this.collection = data.products.collection;
				this.PricesAndStockData = data.products.prices;
				this.is_logged_in = data.is_logged_in;
				this.LoginMode = false,
			    this.RegisterMode = false,
				$("#productModal").modal('show');
			})
			.catch(e => {
				e.response.data.message;
			})
		
		})
	},

    data(){
        return {
            productDetails: [],
			collection: '',
			userData: {},
			PricesAndStockData: [],
			is_logged_in : false,
			LoginMode: false,
			RegisterMode: false,
			buttonLoader: "",
        }
    },
    props: ['postTitle'],
	components: {
		RegisterComponent,
		LoginComponent,
	},
    methods: {
		addToCart(product,product_variant_price){
			this.buttonLoader = product_variant_price.id;
			axios.get('/is_logged_in')
			.then(({data}) => {
				if(data == true){
					this.buttonLoader = "";
					this.$store.dispatch('addProductToCart',{
					product,
					qty: 1,
					product_variant_price,
					})
					// this.buttonLoader = false;
				}else{
					this.RegisterMode = true;
					this.buttonLoader = "";
					iziToast.warning({
						title: 'Warning',
						 position: 'topRight',
						message: 'Please register/login before order',
					});
				}
			})
			.catch(e => {
				this.buttonLoader = "";
				iziToast.error({
					title: 'Error',
					position: 'topRight',
					message: e.response.data.message,
				});
			})

		},
		moveloginMode(){
			this.RegisterMode = false;
			this.LoginMode = true;
		},
		moveRegisterMode(){
			this.LoginMode = false;
			this.RegisterMode = true;
			
		},
		userDataFromServer(data){
			this.userData = data;
			this.LoginMode = false;
			this.RegisterMode = false;
			this.is_logged_in = true;
		},

		userResponse(data){
			this.userData = data;
			this.LoginMode = false;
			this.RegisterMode = false;
			this.is_logged_in = true;
		},
	   getInStock(stock){
		   if(stock > 0){
			   return "<p class='badge badge-warning'>Available</p>"
		   }
		   return "<p class='badge badge-danger'>Out of stock</p>";
		}


    }
}
</script>

<style scoped>
.atc {
    display: inline-block;
    border: 0;
    outline: 0;
    padding: 3px 10px;
    line-height: 1.4;
    background: linear-gradient(#44bc9c,#079992);
    border-radius: 5px;
    font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
    color: white !important;
    font-size: 1.2em;
    cursor: pointer;
    /* Important part */
    position: relative;
    transition: padding-right .3s ease-out;
}
.atc.loading {
    background-color: #CCC;
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
    border: 4px solid rgba(255,255,255,0.5);
    border-left-color: #FFF;
    border-top-color: #FFF;
    animation: spin .6s infinite linear, grow .3s forwards ease-out;
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

</style>