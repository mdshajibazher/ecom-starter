<template>
<div id="top-cart" class="header-misc-icon d-none d-sm-block">
        <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">{{totalcart}}</span></a>
        <div class="top-cart-content">
            <div class="top-cart-title">
                <h4>Shopping Cart</h4>
            </div>
            <div class="top-cart-items">
                <div class="top-cart-item" v-for="(item,index) in cart"  :key="index">
                    <div class="top-cart-item-image">
                        <a href="#"><img :src="'/images/products/thumb/'+item.product.images[0].file_path" :alt="item.product.title"></a>
                    </div>
                    <div class="top-cart-item-desc">
                        <div class="top-cart-item-desc-title">
                            <a href="#">{{item.product.title}}</a>
                            <span class="top-cart-item-price d-block">Tk. {{item.product_variant_price.price}}</span>
                        </div>
                        <div class="top-cart-item-quantity">x {{item.qty}}</div>
                    </div>
                </div>
            </div>
            <div class="top-cart-action">
                <span class="top-checkout-price">Tk. {{totalprice}}</span>
                <a href="#" class="button button-3d button-small m-0">View Cart</a>
            </div>
        </div>
</div>
</template>

<script>
export default {
    mounted(){
        this.$store.dispatch('getCartItem');
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

<style>

</style>