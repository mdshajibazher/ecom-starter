<template>
          <div class="row">
            <div class="col-md-12 col-lg-12">
                <form @submit.prevent="Login" @keydown="form.onKeydown($event)" style="display:inline">
                <div class="alert alert-warning"> Please login here before add any product. Not a Member <a @click="$emit('moveRegisterMode',1)" href="javascript:void(0)" > <b>	Click Here </b> </a> to Register </div>
                 
                  <AlertError :form="form" />

                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" :class="{'is-invalid': form.errors.has('email')}" id="email" v-model="form.email" type="text" class="form-control" placeholder="Enter your email">
                     <small v-if="form.errors.has('email')" class="form-error text-danger">{{form.errors.get('email')}} </small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input :class="{'is-invalid': form.errors.has('password')}" name="password" id="password" v-model="form.password" type="password" class="form-control" placeholder="Enter your password">
                      <small v-if="form.errors.has('password')" class="form-error text-danger">{{form.errors.get('password')}} </small>
                </div>
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" value="" id="top-login-checkbox" name="remember" v-model="form.remember">
                    <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                </div>
                <div class="form-group">
                    <button :disabled="form.busy" type="submit" class="btn btn-success">LOGIN</button>
                </div>
                </form>
            </div>

            <div class="line line-sm"></div>
                <div class="w-100 text-center">
                        <h4 style="margin-bottom: 15px;">or Login with:</h4>
                        <a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
                        <span class="d-none d-md-inline-block">or</span>
                        <a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
            </div>
        </div>
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
                this.$emit('userDataFromServer',data);
                this.$store.dispatch('isLoggedIn');
            })  
            .catch( e => {
                console.log(e);
            })
        }
    
    }
}
</script>

<style>

</style>