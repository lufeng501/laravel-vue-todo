<template>
  <select class="form-control select2">
    <option value="1">111</option>
    <option value="2">222</option>
    <option value="3">333</option>
  </select>
</template>

<script>
  export default {
    mounted: function () {
      var vm = this
      $(this.$el)
//        .val(this.value)
        // init select2
        .select2({})
        // emit event on change.
//        .on('change', function () {
//          vm.$emit('input', this.value)
//        })
    }
  }
</script>

<style>
</style>
