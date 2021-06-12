<template>
  <div>
      <h3>Upload image for <span class="badge badge-danger">{{combination.combination}}</span></h3>
      <div class="form-group">
          <label for="variant-image">Varinat Image</label>
        <vue-dropify v-model="variantImage" uploadIcon="fas fa-arrow-circle-up"/>
      </div>
      <div class="form-group">
          <button @click="uploadImage" type="button" class="btn btn-warning btn-lg btn-block">Upload</button>
      </div>

  </div>
</template>

<script>
import VueDropify from 'vue-dropify';
export default {
    data(){
        return {
            variantImage: [],
            index: "",
            combination: [],
        }
    },
    mounted(){
        this.$root.$on('VARIANT_IMAGE_MODAL_POPUP',(index,combination) => {
            console.log(index);
            console.log(combination);
            this.index = index;
            this.combination = combination;
            $("#imageUploaderModal").modal('show');
        })
    },
    components: {
        VueDropify,
    },
    methods:{
        uploadImage(){
            if(this.variantImage.length < 1){
                alert('please select a image')
                return;
            }
            axios.post('/app/product/variant/upload_temp_image',{variant_image: this.variantImage[0]})
            .then((res) => {
                console.log(res)
            })
            .catch((e) => {
                console.log(e.response.data.message);
            })
        }
    }
}
</script>

<style>

</style>