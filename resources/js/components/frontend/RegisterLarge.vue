<template>
<form @submit.prevent="Register" @keydown="form.onKeydown($event)" class="my-5 py-5 px-5">
           <AlertError :form="form" />
          <div class="row">
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
                        <input name="password" v-model="form.password" type="text" :class="{'is-invalid': form.errors.has('password')}" class="form-control"  placeholder="Enter your password">
                         <small v-if="form.errors.has('password')" class="form-error text-danger">{{form.errors.get('password')}} </small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input v-model="form.password_confirmation" type="text" class="form-control" placeholder="Confirm your password">
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
                    <button type="submit" class="btn btn-success">Register</button>
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
            this.form.post('/register')
            .then(res => {
                console.log(res)
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