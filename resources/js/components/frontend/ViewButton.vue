<template>
  <a @click="ProductDetails()" href="javascript:void(0)" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i> Quick View</a>
</template>

<script>
export default {
    props:['product_id'],
    methods:{
        ProductDetails(){
            this.$root.$emit('PRODUCT_ID_EVENT_BUS', this.product_id);
        }
    }
}
</script>

<style>

</style>