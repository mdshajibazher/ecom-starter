export const ADD_TO_CART = (state,{product,qty,product_variant_price}) => {
    let product_in_cart = state.cart.find((item) => {
        return item.product.id == product.id &&  item.product_variant_price.id == product_variant_price.id;
    })

    if(product_in_cart){
        product_in_cart.qty += qty;
        iziToast.success({
            title: 'Success',
             position: 'topRight',
            message: 'Product Qunatity Incremented',
        });
        return;
    }
    state.cart.push({product,qty,product_variant_price})
    iziToast.success({
        title: 'Success',
         position: 'topRight',
        message: 'Product successfully added to cart',
    });
}

export const SET_CART = (state, cartItems) => {
    state.cart = cartItems;
}

export const IS_LOGGED_IN = (state, status) => {
    state.is_logged_in = status;
}

export const REMOVE_PRODUCT_FROM_CART = (state, product_variant_price_id) => {
    state.cart = state.cart.filter( item => {
        return item.product_variant_price.id !== product_variant_price_id;
    })
    iziToast.success({
        title: 'Success',
         position: 'topRight',
        message: 'Product successfully removed from cart',
    });
}