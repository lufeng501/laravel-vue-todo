<template>
  <div class="content-wrapper" id="fetch-data">
    <section class="content-header">
      <h1>
        {{title}}
        <small>Optional description</small>
      </h1>
    </section>
    <div>
      <br>
      <br>
      <button class="btn btn-lg btn-success" v-on:click="fetch">Ajax请求数据</button>
      <br>
      <br>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        title: "演示Ajax异步请求数据"
      }
    },
    methods: {
      fetch() {
        this.$http.get('http://msg-notify.dev-lu.com/getLogsLists?startTime=2017-03-10&endTime=2017-03-17')
          .then((response) => {
            console.log(response.data)
          })
          .catch(function (response) {
            console.log(response)
          })
      }
    }
  }
</script>

<style>
</style>
