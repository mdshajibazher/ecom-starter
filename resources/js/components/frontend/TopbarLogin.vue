<template>
    <li class="custom-top-links-item" ><a class="custom-top-links-item" @click="ToggleActive()" href="#">Login <i class="icon-angle-down"></i></a>
        <div class="top-links-section" :class="{'menu-pos-invert d-block': isActive}" style="width: 260px"> 
            <form @submit.prevent="Login" @keydown="form.onKeydown($event)" style="display:inline">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" placeholder="Email address" :class="{'is-invalid': form.errors.has('email')}" v-model="form.email">
                    <small v-if="form.errors.has('email')" class="form-error text-danger">{{form.errors.get('email')}} </small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" :class="{'is-invalid': form.errors.has('password')}" name="password"  v-model="form.password" >
                      <small v-if="form.errors.has('password')" class="form-error text-danger">{{form.errors.get('password')}} </small>
                </div>
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" value="" id="top-login-checkbox" name="remember" v-model="form.remember">
                    <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                </div>
                <button class="btn btn-danger btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </li>
</template>

<script>
import Form from 'vform';
import { AlertError } from 'vform';
export default {

    data(){
        return {
            isActive: false,
            form: new Form({
                no_redirect_json_return: true,
                email: '',
                password: '',
                remember: false,
            })
        }
    },
    components:{
        AlertError
    },
    methods:{
        ToggleActive(){
             this.isActive = !this.isActive;
        },
        Login(){
            this.form.busy = true;
            this.form.post('/login')
            .then(({data}) => {
                 this.$store.dispatch('isLoggedIn');
            })  
            .catch(e => {
				iziToast.error({
					title: 'Error',
					position: 'topRight',
					message: e.response.data.message,
				});
			})
        }
    
    }
}
</script>
<style scoped>
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

</style>