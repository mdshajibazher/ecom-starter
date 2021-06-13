<template>
  <div>
      <h3>Upload image for <span class="badge badge-danger">{{combination.combination}}</span></h3>
      <div class="form-group">
          <label for="variant-image">Varinat Image</label>
        <vue-dropify v-model="variantImage" uploadIcon="fas fa-arrow-circle-up"/>
      </div>
      <div class="form-group">
          <button :disabled="disabled" @click="uploadImage" type="button" class="btn btn-warning btn-lg btn-block">Upload</button>
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
            old_image: "",
            disabled: false,
        }
    },
    mounted(){
        $("span.has-icon").click();
        this.$root.$on('VARIANT_IMAGE_MODAL_POPUP',(varinat_data) => {
            if(varinat_data.old_image){
                this.old_image = varinat_data.old_image;
            }
            this.index = varinat_data.index;
            this.combination = varinat_data.combination;
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
            let  varinat_combination_data = {};
            this.disabled = true;
            this.old_image ? varinat_combination_data = {variant_image: this.variantImage, old_image: this.old_image} : varinat_combination_data = {variant_image: this.variantImage}
            
            axios.post('/app/product/variant/upload_temp_image',varinat_combination_data)
            .then((res) => {
                 this.$root.$emit('UPLOADED_VARIANT_IMAGE_DATA',res.data,this.index);
                 $("span.has-icon").click();
                 this.disabled =false;
            })
            .catch((e) => {
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: e.response.data.message,
                });
                console.log(e.response.data.message);
                this.disabled =false;
            })
        }
    }
}
</script>

<style>

</style>