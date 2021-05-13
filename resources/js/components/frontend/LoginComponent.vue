<template>
          <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="alert alert-warning"> Please login here before add any product. Not a Member <a @click="$emit('moveRegisterMode',1)" href="javascript:void(0)" > <b>	Click Here </b> </a> to Register </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" placeholder="Enter your password">
                </div>
            </div>

            <div class="line line-sm"></div>
                <div class="w-100 text-center">
                        <h4 style="margin-bottom: 15px;">or Login with:</h4>
                        <a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
                        <span class="d-none d-md-inline-block">or</span>
                        <a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
            </div>
        </div>
</template>

<script>
export default {

}
</script>

<style>

</style>