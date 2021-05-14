import axios from "axios";

export const getProducts = ({commit}) => {
    // axios.get('http://ecom-api.test/api/products')
    // .then((res) => {
    //     console.log(res);
    //     commit('SET_PRODUCTS',res.data);
    // })
    // .catch((e) => {
    //     console.log(e.response.data.error)
    // })
}

export const getProduct = ({commit},product_id) => {
    // axios.get('http://ecom-api.test/api/products/'+product_id)
    // .then((res) => {
    //     commit('SET_PRODUCT',res.data)
    // })
    // .catch((e) => {
    //     console.log(e.response.data.error)
    // })
}

export const addProductToCart = ({commit}, {product,qty,product_variant_price}) => {
    axios.post('/add_to_cart/',{
        product_id: product.id,
        qty,
        product_variant_price_id: product_variant_price.id,
    })
    .then( (res) => {
        commit('ADD_TO_CART',{product,qty,product_variant_price})
    })
    .catch( e => {
        iziToast.error({
            title: 'Error',
            position: 'topRight',
            message: e.response.data.message,
        });
    })
}

export const getCartItem = ({commit}) => {
    axios.get('/get_cart_items')
    .then((response) => {
        commit('SET_CART',response.data);
    })
    .catch(e => {
        iziToast.error({
            title: 'Error',
            position: 'topRight',
            message: e.response.data.message,
        });
    })
}


export const removeProductFromCart = ({commit},product_variant_price_id) => {
   
    axios.delete('/remove_cart_item/'+product_variant_price_id)
    .then((res) => {
        if(res.status == 200){
            commit('REMOVE_PRODUCT_FROM_CART',product_variant_price_id)
        }
    })
    .catch(e => {
        iziToast.error({
            title: 'Error',
            position: 'topRight',
            message: e.response.data.message,
        });
    })
}