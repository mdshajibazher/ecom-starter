<template>
<form @submit.prevent="Register" @keydown="form.onKeydown($event)" style="display:inline">
          <div class="row">
            <div class="alert alert-warning"> Please register here before add any product.If you already registered <a @click="$emit('moveloginMode',1)" href="javascript:void(0)" > <b>	Click Here </b> </a> to Login </div>
             <AlertError :form="form" />

              <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" :class="{'is-invalid': form.errors.has('name')}" v-model="form.name"  type="text" class="form-control" placeholder="Enter your name">
                        <small v-if="form.errors.has('name')" class="form-error text-danger">{{form.errors.get('name')}} </small>
                    </div>
                    <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" :class="{'is-invalid': form.errors.has('email')}" v-model="form.email" type="text" class="form-control" placeholder="Enter your email">
                            <small v-if="form.errors.has('email')" class="form-error text-danger">{{form.errors.get('email')}} </small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" v-model="form.password" type="password" :class="{'is-invalid': form.errors.has('password')}" class="form-control"  placeholder="Enter your password">
                         <small v-if="form.errors.has('password')" class="form-error text-danger">{{form.errors.get('password')}} </small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Confirm your password">
                    </div>
              </div>

               <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" v-model="form.phone" type="text" :class="{'is-invalid': form.errors.has('phone')}" class="form-control" placeholder="Enter your phone">
                         <small v-if="form.errors.has('phone')" class="form-error text-danger">{{form.errors.get('phone')}} </small>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" :class="{'is-invalid': form.errors.has('address')}" v-model="form.address" cols="30" rows="8" class="form-control"></textarea>
                        <small v-if="form.errors.has('address')" class="form-error text-danger">{{form.errors.get('address')}} </small>
                    </div>
               </div>
                <div class="col-md-12 col-lg-12">
                    <button :disabled="form.busy" type="submit" class="btn btn-success btn-block">Register</button>
                </div>
          </div>
          </form>
</template>

<script>
import Form from 'vform';
import { HasError,AlertError } from 'vform'

export default {
    components:{
        HasError,
        AlertError,
    },
    data(){
        return {
            form: new Form({
                id: '',
                name: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                address: '',
            })
        }
    },

    methods:{
        Register(){
            this.form.busy = true;
            this.form.post('/register')
            .then(({data}) => {
                this.$emit('userResponse',data);
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