<template>
<div v-if="validationErrors">
    <ul class="alert alert-danger">
        <li v-for="(value, key, index) in validationErrors">{{ value }}</li>
    </ul>
</div>
</template>

<script>
export default {
     props: ['errors'],
    computed: {
        validationErrors(){
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    }
}
</script>

<style>

</style>