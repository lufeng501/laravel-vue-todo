<template>
  <div>
    <input type="text" v-bind:value="value" v-on:input="onInput" class="form-control" v-model="data">
  </div>
</template>

<script>
  export default {
    props: {
      value: false,
      form: false
    },
    data() {
      return {
        data: this.form,
      }
    },
    methods: {
      onInput: function (event) {
        this.$emit('input', event.target.value)
      }
    }
  }
</script>

<style>
</style>
