<template>
  <ol class="breadcrumb" id="breadcrumb">

    <li v-for="(item,index) in bread">
      <a href="#"> {{item}}</a>
    </li>
    <!--<li><a href="#"><i class="fa fa-home"></i> 后台</a></li>-->
    <!--<li class="active">首页{{bread}}</li>-->
  </ol>
</template>

<script>
  export default {
    props: {
      bread: false
    },
    data() {
      return {
        msg: '123456'
      }
    }
  }
</script>

<style>
</style>
