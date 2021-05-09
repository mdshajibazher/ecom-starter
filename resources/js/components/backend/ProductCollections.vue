<template>
    <div>
        <vue-modal v-if="showModal" @close="showModal = false">
        <div slot="body">
        <form @keydown="sub_collection_form.onKeydown($event)">
            <div class="form-group">
                    <label for="label">Select a Label</label>
                    <multiselect  track-by="id" :class="{ 'is-invalid': sub_collection_form.errors.has('label') }" label="title" :multiple="false" v-model="sub_collection_form.label" :options="labels"></multiselect>
                    
                    <small class="text-danger" v-if="sub_collection_form.errors.has('label')">{{sub_collection_form.errors.get('label')}}</small>
            </div>
            <div class="form-group">
                <label for="title">Subcollection Title</label>
                <input type="text" :class="{ 'is-invalid': sub_collection_form.errors.has('title') }" class="form-control"  placeholder="Enter Subcollection Title" v-model="sub_collection_form.title">
                <has-error :form="sub_collection_form" field="title"></has-error>
            </div>

            <div class="form-group">
                <vue-dropify v-model="sub_collection_form.image" uploadIcon="fas fa-arrow-circle-up"/>
            </div>
        
        </form>
        </div>
        <div slot="footer">

        <button class="btn btn-danger" @click="showModal = false">
             Close 
        </button>
        <button :disabled="sub_collection_form.busy" @click="storeSubCollection()" type="button" class="btn btn-primary">Submit</button>
        </div>
        </vue-modal>

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>All collections</div>
                </div>
                <div class="page-title-actions">
                    <div class="d-inline-block dropdown">
                        <button @click.prevent="addCollection"  type="button" class="btn-shadow btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-plus-circle fa-w-20"></i>
                            </span>
                            Create Collection
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="col-md-6">
                       
            <div class="main-card mb-3 card p-3">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                         <select v-model="pagnate_per_page" class="form-control" style="width: 80px;height: 35px;" @change="PerPageData">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        <input type="text" class="form-control " placeholder="search" style="width: 200px;height: 35px" v-model="query">
                    </div>
                </div>
                <div class="table-responsive">
                    <table  class="table table-striped table-hover table-bordered" v-if="total_data > 0">
                        <thead>
                        <tr>
                            <th @click="sort('id')" class="text-center" style="cursor: pointer"># <span v-html="getsortIcon(orderByDir)"></span> </th>
                            <th @click="sort('title')" style="cursor: pointer">Title <span v-html="getsortIcon(orderByDir)"></span></th>
                            <th>image</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(collection,index) in pd_collections.data" :key="collection.id">
                                <td>{{pd_collections.from+index}}</td>
                                <td>{{collection.title}}</td>
                                <td><img width="50px" :src="'/images/collections/resized/'+collection.image" alt=""></td>
                                <td><button @click="editCollection(collection)" type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                     <p v-else class="alert alert-danger">Sorry No Data Dound </p>
                     <div class="d-flex justify-content-between">
                            
                    <small>   Showing {{from}} to {{to}} of {{total_data}} entries </small>
                     
                    <pagination  :limit="2" :data="pd_collections" v-if="query === ''" @pagination-change-page="getData"></pagination>

                    <pagination  :limit="2" :data="pd_collections" v-else @pagination-change-page="searchData"></pagination>
                    </div>
                </div>
               
            </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4 position-relative" v-if="formShow">
                        <div @click="closeForm()" class="cross_button"> <i class="fas fa-times"></i></div>
                        <div class="card-body">
                            
                            <form @submit.prevent="editMode ? updateCollection() : saveCollection()" @keydown="collection_form.onKeydown($event)">
                                <p v-if="editMode" class="alert  alert-warning"><b>Warning: </b> You are now editing "{{collection_form.title}}" </p>
                            <div class="form-group">
                                <label for="title">Collection Title</label>
                                <input type="text" :class="{ 'is-invalid': collection_form.errors.has('title') }"  v-model="collection_form.title" placeholder="Enter Collection Title"  class="form-control">

                                  <has-error :form="collection_form" field="title"></has-error>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                     <div class="form-group">
                                        <label for="sub_collection">Select Some Subcollection</label>
                                        <multiselect :close-on-select="false" track-by="id" :class="{ 'is-invalid': collection_form.errors.has('sub_collection') }" label="title" :multiple="true" v-model="collection_form.sub_collection" :options="sub_collection_options"></multiselect>
                                        
                                        <small class="text-danger" v-if="collection_form.errors.has('sub_collection')">{{collection_form.errors.get('sub_collection')}}</small>
                                       
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group mt-3">
                                         <button type="button" @click="showModal = true" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <vue-dropify v-model="collection_form.image" uploadIcon="fas fa-arrow-circle-up"/>
                            </div>

                            <div class="form-group">
                                <img class="img-thumbnail my-3" v-if="!collection_form.image && editMode" style="width: 100%" :src="'/images/collections/resized/'+oldCollectionImage" alt="">
                            </div>

                              <button type="submit" class="btn btn-lg btn-primary"><span v-if="editMode">Update</span> <span v-else>Save</span></button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
    </div>
</template>

<script>
import VueDropify from 'vue-dropify';
import Form from 'vform';
import Multiselect from 'vue-multiselect';
export default {
    created() {
        this.sub_collection_options = this.subcollections;
        this.pd_collections = this.collections;
        this.from = this.collections.from;
        this.to = this.collections.to;
        this.total_data = this.collections.total;
    },
    data() {
        return {
            oldCollectionImage: "",
            formShow: false,
            editMode: false,
            query: "",
            queryField:"title",
            pd_collections: [],
            sub_collection: [],
            sub_collection_options: [],
            showModal: false,
            from: 0,
            to: 0,
            total_data: 0,
            pagnate_per_page: 10,
            orderBy:'id',
            orderByDir:'desc',
            collection_form: new Form({
                id: '',
                title: '',
                image: '',
                sub_collection: '',
            }),
            sub_collection_form: new Form({
                id: '',
                title: '',
                label: '',
                image: '',
            })
        }
    },

    watch:{
        query: function (newQ,oldQ){
            if (newQ === "") {
                this.getData();
            } else {
                this.searchData();
            }
        }
    },
    components: {
        Multiselect,
        'vue-dropify': VueDropify
    },
    props: {
        labels: {
            type: Array,
        },
        collections: {
            type: Object,
        },
        subcollections:{
            type: Array,
        },
        image: {
            type: Object,
        },

    },

    methods: {
        closeForm(){
            this.editMode = false;
            this.collection_form.reset();
            this.collection_form.clear();
             this.formShow = false;
        },

        getData(page=1){
            this.$Progress.start();
            axios.get('/app/getcollections/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    console.log(res);
                    this.pd_collections = res.data;
                    this.total_data = res.data.total;
                    this.from = res.data.from;
                    this.to = res.data.to;
                    this.$Progress.finish()
                })
                .catch(err => {
                    console.log(err);
                    this.$Progress.fail()
                })
        },

        searchData(page=1){
            this.$Progress.start();
            axios.get('/app/collections/'+this.queryField+'/'+this.query+'/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    console.log(res);
                    this.pd_collections = res.data;
                    this.total_data = res.data.total;
                    this.from = res.data.from;
                    this.to = res.data.to;
                    this.$Progress.finish()
                })
                .catch(err => {
                    console.log(err);
                    this.$Progress.fail()
                })
        },

        PerPageData(){
            if(this.query === ''){
                this.getData()
            }else{
                this.searchData()
            }
            console.log(this.pagnate_per_page);
        },
        storeSubCollection(){
        this.$Progress.start();
        this.sub_collection_form.busy = true;
         this.sub_collection_form.post('/app/subcollections')
         .then( ({data}) => {
            console.log(data);
            this.$Progress.finish();
            this.showModal = false;
            this.sub_collection_options = data;
           iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: 'Subcollection Stored Successfully',
            })
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
        // store Collection into database
        saveCollection() {
            this.$Progress.start()
            this.collection_form.busy = true
            this.collection_form.post('/app/collections')
             .then(response => {
                    this.$Progress.finish();
                    this.collection_form.reset();
                    this.collection_form.clear();
                    // this.form.fill(role)
                    iziToast.success({
                        title: 'Success',
                        position: 'topRight',
                        message: response.data.title +'Saved Successfully',
                    });
                this.getData();
                this.formShow = false;

                })
                .catch(e => {
                    console.log(e)
                    iziToast.error({
                            title: 'Error',
                            position: 'topRight',
                            message: e.response.data.message,
                    });
                    this.$Progress.fail()
                })
        

        },

        addCollection(data){
            this.formShow = true;
            this.editMode = false;
            this.collection_form.reset();
            this.collection_form.clear();
        },
        editCollection(data){
            this.formShow = true;
            this.editMode = true;
            this.collection_form.id = data.id;
            this.collection_form.title = data.title;
            this.oldCollectionImage = data.image;
            this.collection_form.sub_collection = data.subcollections;

        },
                // store Collection into database
        updateCollection() {
            this.$Progress.start()
            this.collection_form.busy = true
            this.collection_form.put('/app/collections/'+this.collection_form.id)
             .then(response => {
                    this.$Progress.finish();
                    this.collection_form.reset();
                    this.collection_form.clear();
                    // this.form.fill(role)
                    iziToast.success({
                        title: 'Success',
                        position: 'topRight',
                        message: response.data.title +'Saved Successfully',
                    });
                this.getData();

                this.formShow = false;

                })
                .catch(e => {
                    console.log(e)
                    iziToast.error({
                            title: 'Error',
                            position: 'topRight',
                            message: e.response.data.message,
                    });
                    this.$Progress.fail()
                })
        },
        // this function sort the whole by column name ascending or descending
        sort(argument){
            this.orderBy = argument;
            this.orderByDir == 'desc' ?  this.orderByDir = 'asc' : this.orderByDir = 'desc';
            if(this.query === ''){
                this.getData()
            }else{
                this.searchData()
            }
        },
        getsortIcon(orderByDir){
            if(orderByDir == 'asc'){
                return '<i class="fas  fa-sort-alpha-up"></i>';
            }else{
                return '<i class="fas  fa-sort-alpha-down-alt"></i>';
            }
        },



    }
}
</script>


<style scoped>
.multiselect.is-invalid{
    border: 1px solid red;
    border-radius: 5px;
}
.cross_button{
    position: absolute;
    right: -15px;
    top: -16px;
    z-index: 10;
}
.cross_button i{
    font-size: 19px;
    color: #fff;
    background: red;
    padding: 7px 10px;
    cursor: pointer;
    border-radius: 100%;
}
</style>