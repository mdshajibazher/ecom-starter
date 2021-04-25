<template>
    <div>
<vue-modal v-if="showModal" @close="showModal = false">
        <div slot="body">

            <form @keydown="sub_collection_form.onKeydown($event)">
                <div class="form-group">
                    <label for="title">Subcollection Title</label>
                    <input type="text" :class="{ 'is-invalid': sub_collection_form.errors.has('title') }" class="form-control"  placeholder="Enter Subcollection Title" v-model="sub_collection_form.title">

                     <has-error :form="sub_collection_form" field="title"></has-error>
                </div>
            </form>
        </div>
        <div slot="footer">
            
            <button class="btn btn-danger" @click="showModal = false">
                    x 
            </button>
            <button :disabled="sub_collection_form.busy" @click="addSubCollection()" type="button" class="btn btn-primary">Submit</button>
        </div>
</vue-modal>


            <div class="row" @keydown="errorFree()">
                
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="form-group">
                                <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                            </div>
                            <div class="form-group">
                                <label for="title">Collection Title</label>
                                <input type="text"  :class="{ 'is-invalid': validationErrors.title }" v-model="title" placeholder="Category Title"  class="form-control">
                                <p class="text-danger" v-if="validationErrors.title">{{validationErrors.title[0]}}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                     <div class="form-group">
                                        <label for="sub_collection">Select Some Subcollection</label>
                                        <multiselect v-model="sub_collection" :options="sub_collection_options"></multiselect>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group mt-3">
                                         <button type="button" @click="showModal = true" class="btn btn-success"><i class="fas fa-plus"></i> Add Subcollection</button>
                                    </div>
                                   
                                </div>
                            </div>

  
    
                        </div>
                    </div>

                </div>

            </div>

            <button @click="saveCollection" type="submit" class="btn btn-lg btn-primary"><span v-if="editMode">Update</span> <span v-else>Save</span></button>
           
    </div>
</template>

<script>

import Form from 'vform';
import ValidationErrors from './error/ValidationErrors';
import Multiselect from 'vue-multiselect';
export default {
    components: {
        ValidationErrors,
        Multiselect
    },
    props: {
        editMode: {
            type: Boolean,
            default:false
        },
        labels: {
            type: Array,
        },
        image: {
            type: Object,
        },

    },
    data() {
        return {
            title: '',
            validationErrors: '',
            sub_collection: [],
            sub_collection_options: [],
            showModal: false,

            sub_collection_form: new Form({
                title: '',
            })
        }
    },
    methods: {
        errorFree(){
            this.validationErrors = '';
        },

        addSubCollection(){
        this.$Progress.start();
        this.sub_collection_form.busy = true;
         this.sub_collection_form.post('/app/subcollections')
         .then( ({data}) => {
            console.log(data);
            this.$Progress.finish();
            this.showModal = false;
            this.successMsg("Subcollection Stored Successfully");
         })

         .catch( err => {
             this.$Progress.fail();
             iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: err.response.data.message,
                });
         })

        },
        // store product into database
        saveCollection() {
            this.$Progress.start();
            this.validationErrors = '';


            if(this.editMode){
                // axios.put('/app/product/'+this.products.id, product).then(response => {
                //    this.successMsg("Record updated successfully");
                //    this.$Progress.finish();
                //    window.location = '/app/product';
                // }).catch((error )=> {
                //     let errors=error.response.data.errors;
                //     if (error.response.status == 422){
                //     this.validationErrors = error.response.data.errors;
                //     }
                //     this.errorMsg(errors);
                //     this.$Progress.fail();
                // })

            }else{
                // axios.post('/app/product', product).then(response => {
                //         this.successMsg("Record created successfully");
                //         this.$Progress.finish();
                //         window.location = '/app/product';
                // }).catch((error) => {
                //     let errors=error.response.data.errors;
                //     if (error.response.status == 422){
                //     this.validationErrors = error.response.data.errors;
                //     }
                //     this.errorMsg(errors);
                //     this.$Progress.fail();
                // })
            }

            
        },
        successMsg(msg){
            iziToast.success({
                title: 'Success',
                position: 'topRight',
                message: msg,
            });
        },
        errorMsg(msg){
            $.each(msg,function(index,value) {
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: value,
                });
            })
        }


    },
    created() {

    },
    mounted() {

    }
}
</script>

