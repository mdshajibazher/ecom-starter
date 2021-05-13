<template>
    <div class="quantity">
            <input type="button" value="-" class="increment-btn" @click="decrQty()">
            <input type="text" readonly name="quantity"  :value="qty" class="qty-input"  />
            <input type="button" value="+" class="increment-btn" @click="incrQty(price)">
    </div>
</template>

<script>
export default {
    mounted(){
        	this.$root.$on('PRODUCT_ID_EVENT_BUS',(id) => {
                this.qty =1;
            })
    },
    props: ['price'],
    data(){
        return {
            qty: 1
        }
    },
    methods:{

        incrQty(price){
        this.qty >=price.stock  ?  false :  this.qty++;

        },
        decrQty(){
        this.qty <= 1 ?  false : this.qty--;

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