<template>
    <section>
            <div class="row" @keydown="errorFree()">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="form-group">
                                <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text"  :class="{ 'is-invalid': validationErrors.title }" v-model="product_name" placeholder="Product Name"  class="form-control">
                                <p class="text-danger" v-if="validationErrors.title">{{validationErrors.title[0]}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Product SKU</label>
                                <input type="text" :class="{ 'is-invalid': validationErrors.sku }" v-model="product_sku" placeholder="Enter SKU" class="form-control">
                               <p class="text-danger" v-if="validationErrors.sku">{{validationErrors.sku[0]}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea v-model="description" :class="{ 'is-invalid': validationErrors.description }"  cols="30" rows="4" class="form-control"></textarea>
                                <p class="text-danger" v-if="validationErrors.description">{{validationErrors.description[0]}}</p>
                            </div>

                              <div class="form-group">
                                <label for="sub_collection">Select Collection</label>
                                <multiselect @input="getSubCollectionbyId()"  track-by="id" :class="{ 'is-invalid': validationErrors.collection }" label="title"  v-model="collection" :options="collections_options"></multiselect>
                                
                                <small class="text-danger" v-if="validationErrors.collection">{{validationErrors.collection[0]}}</small>
                                
                            </div>

                            <div class="form-group">
                                <label for="sub_collection">Select Subcollections</label>
                                <multiselect :close-on-select="false" track-by="id" :class="{ 'is-invalid': validationErrors.sub_collections }" label="title" :multiple="true" v-model="sub_collections" :options="subcollections_options"></multiselect>
                                
                                <small class="text-danger" v-if="validationErrors.sub_collections">{{validationErrors.sub_collections[0]}}</small>
                                
                            </div>

                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Media</h6>
                        </div>
                        <div class="card-body border">
                            <div class="mb-4">
                                <vue-dropzone :class="{ 'is-invalid': validationErrors.product_image }" ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" v-on:vdropzone-success="uploadImage" @vdropzone-removed-file="removeImage" @vdropzone-mounted="showImage"></vue-dropzone>
                            </div>
                            <div v-if="imageEditMode">
                                <button @click="clearImg(products.id)" class="btn btn-danger float-right">Clear Image</button>
                            </div>

                             <p class="text-danger" v-if="validationErrors.product_image">{{validationErrors.product_image[0]}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Variants</h6>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            Sizes
                                        </div>
                                        <div class="col-9">
                                            <multiselect :class="{ 'is-invalid': validationErrors.sizes }" @input="generateCombination()"  placeholder="Select some size" :close-on-select="false" track-by="id"  label="title" :multiple="true" v-model="productVariants.sizes" :options="sizes"></multiselect>

                                             <small class="text-danger" v-if="validationErrors.sizes">{{validationErrors.sizes[0]}}</small>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            Colors
                                        </div>
                                        <div class="col-9">
                                            <multiselect :class="{ 'is-invalid': validationErrors.colors }"  @input="generateCombination()"  placeholder="Select some color" :close-on-select="false" track-by="id"  label="title" :multiple="true" v-model="productVariants.colors" :options="colors"></multiselect>
                                             
                                            <small class="text-danger" v-if="validationErrors.colors">{{validationErrors.colors[0]}}</small>
                                        </div>
                                    </div>
                                </div>
                        </div>


                        <div class="card-header text-uppercase">Preview</div>

                        <div class="card-body">
                            <div class="table-responsive">
                                 <p class="alert alert-danger" v-if="validationErrors.variant_combinations">{{validationErrors.variant_combinations[0]}}</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>Variant</td>
                                        <td>Price</td>
                                        <td>Stock</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(combination,index) in variant_combinations" :key="index">
                                        <td>{{combination.size.title  +' / '+  combination.color.title}}</td>
                                        <td>
                                            <input type="text" class="form-control" v-model="combination.price">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" v-model="combination.stock">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <button @click="saveProduct" type="submit" class="btn btn-lg btn-primary"><span v-if="edit_mode">Update</span> <span v-else>Save</span></button>
            <a href="/product" class="btn btn-secondary btn-lg">Cancel</a>
    </section>
</template>

<script>
import Multiselect from 'vue-multiselect';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import ValidationErrors from '../error/ValidationErrors';

export default {

    created() {
        if (this.edit_mode==false) {
            this.$set(this.dropzoneOptions,'addRemoveLinks',true);
        }
        this.collections_options = this.collections_props;


    },
    mounted() {
        this.colors = this.colors_props;
        this.sizes = this.sizes_props;
        if (this.edit_mode==false) {
            this.imageEditMode=false;
        }
        if(this.edit_mode){
            this.imageEditMode=true;
            this.product_name=this.products.title;
            this.product_sku=this.products.sku;
            this.description=this.products.description;
            this.collection = this.products.collection;
            this.sub_collections = this.products.subcollections;
            var ref=this;

            this.productVariants.sizes = this.products.sizes;
            this.productVariants.colors = this.products.colors;

            /*product_prices*/
            console.log(ref.prices.prices);
            ref.prices.prices.forEach((value) => {
                console.log( this.productVariants);
                ref.variant_combinations.push({
                    combination: value.label,
                    size: value.size,
                    color: value.color,
                    price: value.price,
                    stock: value.stock,
                })
            })
            
            /*images*/
            ref.image.images.forEach((value) => {
                ref.prevUplodedImage.push(value.file_path);
            })
        }
    } ,
    data() {
        return {
            sizes: [],
            colors: [],
            imageEditMode:false,
            collection: '',
            collections_options: [],
            sub_collections: '',
            subcollections_options: [],
            product_name: '',
            product_sku: '',
            description: '',
            images: [],
            prevUplodedImage: [],
            validationErrors: '',
            variant_combinations: [],
            productVariants: {
                colors: [],
                sizes: [],
            },
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                // thumbnailWidth: 215,
                // maxFilesize: 0.5,
                acceptedFiles: '.jpg, .jpeg, .png .gif',
                addRemoveLinks: false,
                dictDefaultMessage: "<i class='fas fa-cloud-upload-alt fa-5x'></i>",
                headers: {
                    "My-Awesome-Header": "header value",
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                }
            }
        }
    },


    components: {
        vueDropzone: vue2Dropzone,
        ValidationErrors,
        Multiselect
    },
    props: {
        edit_mode: {
            type: Boolean,
            default:false
        },
        products: {
            type: Object,
        },
        image: {
            type: Object,
        },
        prices: {
            type: Object,
        },
        collections_props:{
             type: Array,
        },
        colors_props: {
            type: Array,
        },
        sizes_props: {
            type: Array,
        }


    },

    methods: {
        // it will push a new object into product variant
        uploadImage(file) {
            let image=file.dataURL;
            this.images.push(image);
            iziToast.success({
                title: 'Success',
                message: "Image upload success",
            });
        },
        getSubCollectionbyId(){
            this.sub_collections = "";
            if(this.collection == null){
                this.subcollections_options = [];
            }else{
            axios.get('/app/collections/'+this.collection.id)
            .then( ({data}) => {
                this.subcollections_options = data.subcollections;
            })
            .catch( (e) => {
                  iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: e.response.data.message,
                });
            })
            }
        },
        errorFree(){
            this.validationErrors = '';
        },

        removeImage(file){
            let image=file.dataURL;
            this.images.pop(image);
        },
        showImage(){
            var ref=this;
            var img=ref.prevUplodedImage;
            this.imageEditMode=true;
            if (this.imageEditMode) {
                var file = { size: 215,name:'image', type: "image/png" };
                var url = '';
                ref.$nextTick(function() {
                    for (var i = 0; i <ref.prevUplodedImage.length; i++) {
                        this.$set(file,'name',img[i]);
                        url = '/images/products/thumb/'+img[i];
                        ref.$refs.myVueDropzone.manuallyAddFile(file, url);
                    }
                });
            }
        },
        clearImg(id){
            let confirmation = confirm('are you sure you want to clear ? images will be deleted permanently');
            if(confirmation){
            this.imageEditMode=false;
            axios.post(`/app/product/${id}/deleteimages`)
            .then(({data}) => {
                this.$refs.myVueDropzone.$el.innerHTML='';
                this.images=[];
                iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: data
                });
            })
            .catch(e => {
                iziToast.error({
                title: 'Error',
                position: 'topRight',
                message: e.response.data.message,
            });
            })
            }
        },


        generateCombination(){
            // console.log(selected_data);
            let old_combinations =  this.variant_combinations;
            let new_combination = [];
            let final_combinations = [];
            let selected_sizes = this.productVariants.sizes;
            let selected_colors = this.productVariants.colors;
 
            selected_sizes.forEach((size) => {
                selected_colors.forEach((color) => {
                   new_combination.push({
                       combination: size.title+'/'+color.title,
                       size: size,
                       color: color,
                       price: 0,
                       stock: 0,
                   })
                })
            })

            if(old_combinations.length > 0){
                new_combination.forEach((newData,index) => {
                    let oldDataExist =  old_combinations.find((data) => {
                        return data.combination == newData.combination;
                    });
                    if(oldDataExist){
                        new_combination[index] = oldDataExist;
                    }
                })
            }

            final_combinations= new_combination;
            this.variant_combinations = final_combinations;
        },




        // store product into database
        saveProduct() {
            this.$Progress.start();
            this.validationErrors = '';
            let product = {
                editImage:this.imageEditMode,
                title: this.product_name,
                sku: this.product_sku,
                sizes: this.productVariants.sizes,
                colors: this.productVariants.colors,
                collection: this.collection,
                description: this.description,
                product_image: this.images,
                product_variant: this.product_variant,
                variant_combinations: this.variant_combinations,
                sub_collections: this.sub_collections
            }

            if(this.edit_mode){
                axios.put('/app/product/'+this.products.id, product).then(response => {
                   this.successMsg("Record updated successfully");
                   this.$Progress.finish();
                //    window.location = '/app/product';
                }).catch((error )=> {
                    let msg =error.response.data.message;
                    if (error.response.status == 422){
                    iziToast.error({
                        title: 'Error',
                        position: 'topRight',
                        message: msg,
                    });
                    this.validationErrors = error.response.data.errors;
                    }
                    this.$Progress.fail();
                })

            }else{
                axios.post('/app/product', product).then(response => {
                        this.successMsg("Record created successfully");
                        this.$Progress.finish();
                        // window.location = '/app/product';
                }).catch((error) => {
                    let msg =error.response.data.message;
                    if (error.response.status == 422){
                    iziToast.error({
                        title: 'Error',
                        position: 'topRight',
                        message: msg,
                    });
                    this.validationErrors = error.response.data.errors;
                    }
                    this.$Progress.fail();
                })
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


    }

}
</script>

<style scoped>
    .vue-dropzone.is-invalid{
        border-color: red !important;
    }
    .multiselect.is-invalid{
    border: 1px solid red;
    border-radius: 5px;
}
</style>