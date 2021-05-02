<template>
    <div>

        <vue-modal v-if="showModal" @close="showModal = false">
        <div slot="body">

        <form @keydown="label_form.onKeydown($event)">
            <div class="form-group">
                <label for="title">Label Title</label>
                <input type="text" :class="{ 'is-invalid': label_form.errors.has('title') }" class="form-control"  placeholder="Enter Label Title" v-model="label_form.title">
                <has-error :form="label_form" field="title"></has-error>
            </div>


        
        </form>
        </div>
        <div slot="footer">

        <button class="btn btn-danger" @click="showModal = false">
                Close 
        </button>
        <button :disabled="label_form.busy" @click="storeLabel()" type="button" class="btn btn-primary">Submit</button>
        </div>
        </vue-modal>





     <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All subcollections</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button @click.prevent="addSubcollection"  type="button" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Subcollection
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
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(Subcollection,index) in pd_subcollections.data" :key="Subcollection.id">
                                <td>{{pd_subcollections.from+index}}</td>
                                <td>{{Subcollection.title}}</td>
                                <td><button @click="editSubcollection(Subcollection)" type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                     <p v-else class="alert alert-danger">Sorry No Data Dound </p>
                     <div class="d-flex justify-content-between">
                            
                    <small>   Showing {{from}} to {{to}} of {{total_data}} entries </small>
                     
                    <pagination  :limit="2" :data="pd_subcollections" v-if="query === ''" @pagination-change-page="getData"></pagination>

                    <pagination  :limit="2" :data="pd_subcollections" v-else @pagination-change-page="searchData"></pagination>
                    </div>
                </div>
               
            </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4 position-relative" v-if="formShow">
                        <div @click="closeForm()" class="cross_button"> <i class="fas fa-times"></i></div>
                        <div class="card-body">
                            
                            <form @submit.prevent="editMode ? updateSubcollection() : saveSubcollection()" @keydown="subcollection_form.onKeydown($event)">
                                <p v-if="editMode" class="alert  alert-warning"><b>Warning: </b> You are now editing "{{subcollection_form.title}}" </p>
                            <div class="form-group">
                                <label for="title">Subcollection Title</label>
                                <input type="text" :class="{ 'is-invalid': subcollection_form.errors.has('title') }"  v-model="subcollection_form.title" placeholder="Enter Subcollection Title"  class="form-control">

                                  <has-error :form="subcollection_form" field="title"></has-error>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                     <div class="form-group">
                                        <label for="sub_collection">Select a Label</label>
                                        <multiselect  track-by="id" :class="{ 'is-invalid': subcollection_form.errors.has('label') }" label="title" v-model="subcollection_form.label" :options="label_options"></multiselect>
                                        
                                        <small class="text-danger" v-if="subcollection_form.errors.has('label')">{{subcollection_form.errors.get('label')}}</small>
                                       
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group mt-3">
                                         <button type="button" @click="showModal = true" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                                    </div>
                                   
                                </div>
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

import Form from 'vform';
import Multiselect from 'vue-multiselect';
export default {
    created() {
        this.label_options = this.labels;
        this.pd_subcollections = this.subcollections;
        this.from = this.subcollections.from;
        this.to = this.subcollections.to;
        this.total_data = this.subcollections.total;
    },
    data() {
        return {
            formShow: false,
            editMode: false,
            query: "",
            queryField:"title",
            pd_subcollections: [],
            sub_collection: [],
            label_options: [],
            showModal: false,
            from: 0,
            to: 0,
            total_data: 0,
            pagnate_per_page: 10,
            orderBy:'id',
            orderByDir:'desc',
            subcollection_form: new Form({
                id: '',
                title: '',
                label: '',
            }),
            label_form: new Form({
                id: '',
                title: '',
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
        Multiselect
    },
    props: {
        labels: {
            type: Array,
        },
        subcollections: {
            type: Object,
        },
        image: {
            type: Object,
        },

    },

    methods: {
        closeForm(){
            this.editMode = false;
            this.subcollection_form.reset();
            this.subcollection_form.clear();
             this.formShow = false;
        },

        getData(page=1){
            this.$Progress.start();
            axios.get('/app/getsubcollections/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    this.pd_subcollections = res.data;
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
            axios.get('/app/subcollections/'+this.queryField+'/'+this.query+'/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    this.pd_subcollections = res.data;
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
        },
        storeLabel(){
        this.$Progress.start();
        this.label_form.busy = true;
         this.label_form.post('/app/labels')
         .then( ({data}) => {
            this.$Progress.finish();
            this.showModal = false;
            this.label_options = data;
           iziToast.success({
                    title: 'Success',
                    position: 'topRight',
                    message: data.title+ ' Stored Successfully',
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
        // store Subcollection into database
        saveSubcollection() {
            this.$Progress.start()
            this.subcollection_form.busy = true
            this.subcollection_form.post('/app/subcollections')
             .then(response => {
                    this.$Progress.finish();
                    this.subcollection_form.reset();
                    this.subcollection_form.clear();
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

        addSubcollection(data){
            this.formShow = true;
            this.editMode = false;
            this.subcollection_form.reset();
            this.subcollection_form.clear();
        },
        editSubcollection(data){
            this.formShow = true;
            this.editMode = true;
            this.subcollection_form.id = data.id;
            this.subcollection_form.title = data.title;
            this.subcollection_form.label = data.label;

        },
                // store product into database
        updateSubcollection() {
            this.$Progress.start()
            this.subcollection_form.busy = true
            this.subcollection_form.put('/app/subcollections/'+this.subcollection_form.id)
             .then(response => {
                    this.$Progress.finish();
                    this.subcollection_form.reset();
                    this.subcollection_form.clear();
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