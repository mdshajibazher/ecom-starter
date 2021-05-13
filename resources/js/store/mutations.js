export const ADD_TO_CART = (state,{product,qty,product_variant_price}) => {
    let product_in_cart = state.cart.find((item) => {
        return item.product.id == product.id &&  item.product_variant_price.id == product_variant_price.id;
    })

    if(product_in_cart){
        product_in_cart.qty += qty;
        return;
    }
    state.cart.push({product,qty,product_variant_price})
}

export const SET_CART = (state, cartItems) => {
    state.cart = cartItems;
}

export const REMOVE_PRODUCT_FROM_CART = (state, product) => {
    // state.cart = state.cart.filter( item => {
    //     return item.product.id !== product.id
    // })
}