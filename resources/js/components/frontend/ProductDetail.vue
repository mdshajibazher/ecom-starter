<template>
  			<div class="single-product shop-quick-view-ajax">
				<div class="product modal-padding">
							<h2>{{productDetails.title}}</h2>
							<hr>
							<div class="d-flex" >
								<img v-for="(image,index) in productDetails.images" :key="index" style="width: 25%;margin-right: 10px" class="img-thumbnail" :src="'/images/products/thumb/'+image.file_path" alt="Pink Printed Dress">
							</div>
							<hr>
							<div class="pd-variation">
								<h5 class="text-center">Variations</h5>
								<table class="table">
									<tr v-for="(price,index) in productDetails.prices" :key="index">
										<td>
										<b>
										{{price.variant_one==null?'':price.variant_one.variant+'/' }} 
                                        {{price.variant_two==null?'':price.variant_two.variant+'/' }}
                                        {{price.variant_three==null?'':price.variant_three.variant+'/' }}
									   </b>
										<div class="product-price"> Price: <ins>{{ price.price }}</ins></div>
										</td>
										<td>
											<div class="quantity">
												<input type="button" value="-" class="increment-btn">
												<input type="text"  name="quantity"  value="1" title="Qty" class="qty-input" size="4" />
												<input type="button" value="+" class="increment-btn">
											</div>
										</td>

										<td><button type="submit" class="atc btn btn-dark"><i class="icon-shopping-basket"></i></button>
										</td>
									</tr>
								</table>
							</div>
		
							<p>{{productDetails.description}}</p>
							<ul class="iconlist">
								<li><i class="icon-caret-right"></i> Dynamic Color Options</li>
								<li><i class="icon-caret-right"></i> Lots of Size Options</li>
								<li><i class="icon-caret-right"></i> 30-Day Return Policy</li>
							</ul>
							<div class="card product-meta mb-0">
								<div class="card-body">
									<span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">{{productDetails.sku}}</span></span>
									<span class="posted_in">Category: <a v-for="(sub,index) in productDetails.subcollections" :key="index" href="#" rel="tag">{{sub.title}}</a>,</span>
									<!-- <span class="tagged_as">Category: <a href="#" rel="tag">Barena</a> </span> -->
								</div>
							</div>

				</div>
		
			</div> 
</template>

<script>
export default {
	mounted(){
		this.$root.$on('PRODUCT_ID_EVENT_BUS',(id) => {
			axios.get('/product_details/'+id)
			.then(({data}) => {
				this.productDetails = data;
				console.log(data);
				$("#productModal").modal('show');
			})
			.catch(e => {
				e.response.data.message;
			})
		
		})
	},
    data(){
        return {
            productDetails: []
        }
    },
    props: ['postTitle'],
    methods: {
        testFunction(){
            
        }
    }
}
</script>

<style scoped>
	.button{
		padding: 5px 8px;
	}
	.increment-btn{
    display: block;
    cursor: pointer;
    border: 0px transparent;
    padding: 0;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    background-color: #EEE;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color .2s linear;
    -webkit-transition: background-color .2s linear;
	}
	.qty-input{
		width: 40px;
    height: 30px;
    line-height: 40px;
    border: 0;
    border-left: 1px solid #DDD;
    border-right: 1px solid #DDD;
    background-color: #EEE;
    text-align: center;
    margin-bottom: 0;
	}
</style>