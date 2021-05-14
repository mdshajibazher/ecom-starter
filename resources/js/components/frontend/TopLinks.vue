<template>
  <div class="top-links on-click">
    <ul class="top-links-container">
        <li v-if="is_logged_in" class="top-links-item"><a href="#">My Account</a>
            <ul class="top-links-sub-menu">
                <li class="top-links-item"><a href="#">Profile</a></li>
                <li class="top-links-item"><a href="">Logout</a></li>
            </ul>
        </li>
        <TopbarLogin v-if="!is_logged_in"/>
    </ul>
</div>
</template>

<script>
import TopbarLogin from './TopbarLogin'
export default {
    mounted(){
        this.$store.dispatch('isLoggedIn');
    },
    computed: {
        is_logged_in(){
            return this.$store.state.is_logged_in;
        }
    },
    components:{
        TopbarLogin
    }
}
</script>

<style>

</style>