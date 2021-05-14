export const CartItemCount = (state) => {
    return state.cart.length;
}

export const CartTotalPrice = (state) => {
    let total = 0;
    // if(state.cart){
        state.cart.forEach((item) => {
            total += parseFloat(item.product_variant_price.price) * parseFloat(item.qty);
        });
    // }
    return total;
}