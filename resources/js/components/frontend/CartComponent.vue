<template>
<div id="top-cart" class="header-misc-icon d-none d-sm-block">
        <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">{{totalcart}}</span></a>
        <div class="top-cart-content">
            <div class="top-cart-title">
                <h4>Shopping Cart</h4>
            </div>
            <div v-if="totalcart > 0">
            <div class="top-cart-items">
                <div class="top-cart-item" v-for="(item,index) in cart"  :key="index">
                    <div class="top-cart-item-image">
                        <a href="#"><img :src="'/images/products/thumb/'+item.product.images[0].file_path" :alt="item.product.title"></a>
                    </div>
                    <div class="top-cart-item-desc">
                        <div class="top-cart-item-desc-title">
                            <a href="#">{{item.product.title}}</a>

                              <span class="top-cart-item-price d-block text-uppercase">
                                 <span class="badge badge-dark mb-0">{{ item.product_variant_combination.label}} 
                                 </span>
                              </span>
                            <span class="top-cart-item-price d-block">{{item.product_variant_combination.price}} x {{item.qty}} = {{item.product_variant_combination.price*item.qty}} Tk. </span>
                        </div>
                        <div class="top-cart-item-quantity">
                          <button @click.prevent="removeProductFromCart(item.product_variant_combination.id)" type="button" class="btn btn-sm btn-danger">x</button> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-cart-action">
                <span class="top-checkout-price">Tk. {{totalprice}}</span>
                <a href="#" class="button button-3d button-small m-0">View Cart</a>
            </div>
            </div>

            <div v-else class="top-cart-items">
                <p class="alert alert-danger">! No items </p>
            </div>
        </div>
</div>
</template>

<script>
export default {
    mounted(){
        this.$store.dispatch('getCartItem');
    },
    methods:{
        removeProductFromCart(product_variant_combination_id){
            this.$store.dispatch('removeProductFromCart',product_variant_combination_id)
        }
    },
    computed: {
        cart(){
            return this.$store.state.cart
        },
        totalcart(){
            return this.$store.getters.CartItemCount;
        },
        totalprice(){
            return this.$store.getters.CartTotalPrice;
        },
    }
}
</script>

<style scoped>
.top-cart-item-image{
    width: 64px;
    height: 64px;
}
.top-cart-item-image a, .top-cart-item-image img{
        width: 60px;
    height: 60px;

}
</style>