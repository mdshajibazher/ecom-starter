<template>
    <li class="top-links-item"><a href="#">Login</a>
        <div class="top-links-section">
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
        Login(){
            this.form.busy = true;
            this.form.post('/login')
            .then(({data}) => {
                 this.$store.dispatch('isLoggedIn');
            })  
            .catch( e => {
                console.log(e);
            })
        }
    
    }
}
</script>