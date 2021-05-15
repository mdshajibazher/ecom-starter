<template>
  <div class="custom-top-links">
    <ul class="top-links-container">
        <li v-if="is_logged_in" class="custom-top-links-item"><a @click="ToggleActive()" href="#">My Account <i class="icon-angle-down"></i></a>
            <ul class="top-links-sub-menu" :class="{'d-block': isActive}">
                <li class="custom-top-links-item"><a href="#">Profile</a></li>
                <li class="custom-top-links-item"><a @click="Logout" href="javascript:void(0)">Logout</a></li>
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
    data(){
        return {
            isActive: false,
        }
    },
    computed: {
        is_logged_in(){
            return this.$store.state.is_logged_in;
        }
    },
    methods:{
        ToggleActive(){
             this.isActive = !this.isActive;
        },
        Logout(){
            axios.post('/logout')
            .then( (res) => {
                location.reload(true);
            })
            .catch(e => {
				iziToast.error({
					title: 'Error',
					position: 'topRight',
					message: e.response.data.message,
				});
			})

        },
    },
    components:{
        TopbarLogin
    }
}
</script>

<style scoped>

.custom-top-links {
	position: relative;
	-ms-flex: 0 0 auto;
	flex: 0 0 auto;
	-ms-flex-positive: 0;
	flex-grow: 0;
	border-bottom: 1px solid #EEE;
}

@media (min-width: 768px) {
	.custom-top-links {
		border-bottom: 0;
	}
}
.custom-top-links-item {
	position: relative;
	border-left: 1px solid #EEE;
}

.custom-top-links-item:first-child,
.top-links-sub-menu .custom-top-links-item { border-left: 0 !important; }

.custom-top-links-item > a {
	display: block;
	padding: 12px;
	font-size: 0.75rem;
	line-height: 20px;
	font-weight: 700;
	text-transform: uppercase;
	color: #666;
}

.custom-top-links-item > a > i { vertical-align: top; }

.custom-top-links-item > a > i.icon-angle-down { margin: 0 0 0 5px !important; }

.custom-top-links-item > a > i:first-child { margin-right: 3px; }

.custom-top-links-item.full-icon > a > i {
	top: 2px;
	font-size: 0.875rem;
	margin: 0;
}

.custom-top-links-item:hover { background-color: #EEE; }

.top-links-sub-menu,
.top-links-section {
	position: absolute;
	visibility: hidden;
	pointer-events: none;
	opacity: 0;
	list-style: none;
	z-index: -1;
	line-height: 1.5;
	background: #FFF;
	border: 0;
	top: 100%;
	left: -1px;
	width: 140px;
	margin-top: 10px;
	border: 1px solid #EEE;
	border-top-color: #1ABC9C;
	box-shadow: 0px 13px 42px 11px rgba(0, 0, 0, 0.05);
	transition: opacity .25s ease, margin .2s ease;
}


.custom-top-links .top-links-sub-menu,
.custom-top-links .top-links-section {
	display: none;
}

</style>