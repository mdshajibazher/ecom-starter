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
                            <div class="row" v-for="(item,index) in product_variant" :key="index">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="text-danger" v-if="validationErrors.variant_tag">{{validationErrors.variant_tag[0][0]}}</p>


                                        <label for="">Option</label>
                                        <select v-model="item.option" class="form-control">
                                            <option v-for="(variant,index) in variants"
                                                    :value="variant.id" :key="index">
                                                {{ variant.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label v-if="product_variant.length != 1" @click="product_variant.splice(index,1); checkVariant()"
                                               class="float-right text-primary"
                                               style="cursor: pointer;">Remove</label>
                                        <label v-else for="">.</label>
                                        <input-tag v-model="item.tags" @input="checkVariant" class="form-control"></input-tag>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" v-if="product_variant.length < variants.length && product_variant.length < 3">
                            <button @click="newVariant"  class="btn btn-primary">Add another option</button>
                        </div>

                        <div class="card-header text-uppercase">Preview</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <p class="text-danger" v-if="validationErrors.product_variant_prices">{{validationErrors.product_variant_prices[0]}}</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>Variant</td>
                                        <td>Price</td>
                                        <td>Stock</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="variant_price in product_variant_prices" :key="variant_price.id">
                                        <td>{{ variant_price.title }}</td>
                                        <td>
                                            <input type="text" class="form-control" v-model="variant_price.price">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" v-model="variant_price.stock">
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
import InputTag from 'vue-input-tag'
import ValidationErrors from '../error/ValidationErrors';

export default {

    created() {
        if (this.edit_mode==false) {
            this.$set(this.dropzoneOptions,'addRemoveLinks',true);
        }
        this.collections_options = this.props_collections;


    },
    mounted() {
        if (this.edit_mode==false) {
            this.imageEditMode=false;
        }
        if(this.edit_mode){
            console.log(this.products);
            this.imageEditMode=true;
            this.product_name=this.products.title;
            this.product_sku=this.products.sku;
            this.description=this.products.description;
            this.collection = this.products.collection;
            this.sub_collections = this.products.subcollections;
            this.product_variant=[];
            var available_variants=[];
            var ref=this;

            /*product_variant*/
            $.each(ref.products.product_variants,function(index,value) {
                let tag=[];
                available_variants[index];
                $.each(value,function(key,variant) {
                    tag.push(variant.variant);
                 })
                ref.product_variant.push({
                    option: index,
                    tags: tag
                })
            })
            
            /*product_prices*/
            $.each(ref.prices.prices,function(index,value) {
                let items='';
                let variant_one=(value.variant_one == null)?'':value.variant_one.variant+'/';
                let variant_two=value.variant_two == null?'':value.variant_two.variant+'/';
                let variant_three=value.variant_three == null?'':value.variant_three.variant+'/';
                items=variant_one+variant_two+variant_three;
                
                ref.product_variant_prices.push({
                    title: items,
                    price: value.price,
                    stock: value.stock
                })
            })
            
            /*images*/
            $.each(ref.image.images,function(key,value) {
                ref.prevUplodedImage.push(value.file_path);
            })
        }
    } ,
    data() {
        return {
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
            product_variant: [
                {
                    option: this.variants[0].id,
                    tags: []
                }
            ],
            product_variant_prices: [],
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
        InputTag,
        ValidationErrors,
        Multiselect
    },
    props: {
        edit_mode: {
            type: Boolean,
            default:false
        },
        variants: {
            type: Array,
            required: true
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
        props_collections:{
             type: Array,
        },

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
            if(this.collection == null){
                this.subcollections_options = [];
            }else{
            axios.get('/app/collections/'+this.collection.id)
            .then( ({data}) => {
                this.subcollections_options = data.subcollections;
                console.log(data);
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
            console.log(image);
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
                        console.log(img[i]);
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
        newVariant() {
            let all_variants = this.variants.map(el => el.id)
            let selected_variants = this.product_variant.map(el => el.option);
            let available_variants = all_variants.filter(entry1 => !selected_variants.some(entry2 => entry1 == entry2))
            console.log(available_variants)

            this.product_variant.push({
                option: available_variants[0],
                tags: []
            })
        },

        // check the variant and render all the combination
        checkVariant() {
            console.log('removed');
            let tags = [];
            this.product_variant_prices = [];
            this.product_variant.filter((item) => {
                tags.push(item.tags);
            })

            this.getCombn(tags).forEach(item => {
                this.product_variant_prices.push({
                    title: item,
                    price: 0,
                    stock: 0
                })
            })
        },

        // combination algorithm
        getCombn(arr, pre) {
            pre = pre || '';
            if (!arr.length) {
                return pre;
            }
            let self = this;
            let ans = arr[0].reduce(function (ans, value) {
                return ans.concat(self.getCombn(arr.slice(1), pre + value + '/'));
            }, []);
            return ans;
        },

        // store product into database
        saveProduct() {
            this.$Progress.start();
            this.validationErrors = '';
            let product = {
                editImage:this.imageEditMode,
                title: this.product_name,
                sku: this.product_sku,
                collection: this.collection,
                description: this.description,
                product_image: this.images,
                product_variant: this.product_variant,
                product_variant_prices: this.product_variant_prices,
                sub_collections: this.sub_collections
            }

            if(this.edit_mode){
                axios.put('/app/product/'+this.products.id, product).then(response => {
                   this.successMsg("Record updated successfully");
                   this.$Progress.finish();
                //    window.location = '/app/product';
                }).catch((error )=> {
                    let errors=error.response.data.errors;
                    if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                    }
                    this.errorMsg(errors);
                    this.$Progress.fail();
                })

            }else{
                axios.post('/app/product', product).then(response => {
                        this.successMsg("Record created successfully");
                        this.$Progress.finish();
                        // window.location = '/app/product';
                }).catch((error) => {
                    let errors=error.response.data.errors;
                    if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                    }
                    this.errorMsg(errors);
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