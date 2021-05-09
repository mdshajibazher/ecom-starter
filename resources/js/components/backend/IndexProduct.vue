<template>
    <div>

     <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>All Products</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a :href="url.url+'/app/product/create'"  class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Product
                    </a>
                </div>
            </div>
        </div>
    </div>




            <div class="row">
                <div class="col-md-12">
                        
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
                                <th>Variant</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(pd,index) in products_collections.data" :key="pd.id">
                                    <td>{{products_collections.from+index}}</td>
                                    <td>{{pd.title}}</td>
                                    <td>
                                        <div v-bind:class="{ 'h-auto': pd.id == expand_id }" style="height: 80px; overflow: hidden" id="variant">
                                        <table class="table" v-for="(price,index) in pd.prices" :key="index">
                                            <tr>
                                                <th>{{price.variant_one==null?'':price.variant_one.variant+'/' }} 
                                                {{price.variant_two==null?'':price.variant_two.variant+'/' }}
                                                {{price.variant_three==null?'':price.variant_three.variant+'/' }} </th>
                                            </tr>
                                            <tr>
                                                <td>Price :  <b>{{ price.price }}</b> InStock :  <b>{{ price.stock }}</b> </td>
                                            </tr>
                                        </table>
                                        </div>

                                    <button v-if="expand_id != pd.id" @click="expand_id = pd.id" class="btn btn-sm btn-link">Show more</button>

                                    <button v-if="expand_id == pd.id" @click="expand_id = null" class="btn btn-sm btn-link">Show Less</button>
                                </td>
                                    <td><a :href="url.url+'/app/product/'+pd.id+'/edit'" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <p v-else class="alert alert-danger">Sorry No Data Dound </p>
                        <div class="d-flex justify-content-between">
                                
                        <small>   Showing {{from}} to {{to}} of {{total_data}} entries </small>
                        
                        <pagination  :limit="2" :data="products_collections" v-if="query === ''" @pagination-change-page="getData"></pagination>

                        <pagination  :limit="2" :data="products_collections" v-else @pagination-change-page="searchData"></pagination>
                        </div>
                    </div>
                
                </div>
                </div>
            </div>
    </div>
</template>

<script>

export default {
    created() {
        this.products_collections = this.products;
        this.from = this.products.from;
        this.to = this.products.to;
        this.total_data = this.products.total;
    },
    data() {
        return {
            expand_id: null,
            query: "",
            queryField:"title",
            products_collections: [],
            from: 0,
            to: 0,
            total_data: 0,
            pagnate_per_page: 10,
            orderBy:'id',
            orderByDir:'desc',
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

    },
    props: {
        variants: {
            type: Array,
        },
        products: {
            type: Object,
        },
        url:{
            type: Object
        }

    },

    methods: {

        getData(page=1){
            this.$Progress.start();
            axios.get('/app/getproducts/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    this.products_collections = res.data;
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
            axios.get('/app/products/'+this.queryField+'/'+this.query+'/?page='+page+'&per_page='+this.pagnate_per_page+'&orderBy='+this.orderBy+'&orderByDir='+this.orderByDir)
                .then(res => {
                    this.products_collections = res.data;
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


