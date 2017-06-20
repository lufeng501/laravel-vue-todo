<template>
  <div class="content-wrapper" id="jquery">
    <h1>{{title}}</h1>
    <br>
    <br>
    <div>
      <input type="text" id="datepicker" value="123456" class="form-control select2"/>
    </div>

    <div>
      <button class="btn btn-default" v-on:click="click">点击一下</button>
    </div>

    <br>

    <div>
      <select id="select2" class="form-control select2">
        <option value="1">111</option>
        <option value="2">222</option>
        <option value="3">333</option>
      </select>
    </div>

  </div>
</template>

<script>
  import $ from 'jquery'
  import * as func from '../../include/common'
  import Base from '../../include/BaseClass'
  import '../../plugins/datepicker/datepicker3.css'
  import '../../plugins/datepicker/bootstrap-datepicker'
  import '../../plugins/datepicker/locales/bootstrap-datepicker.zh-CN'
  import '../../plugins/select2/select2.css'
  import '../../plugins/select2/select2'

  $(function () {

//    $('#select2').select2();

//    $.ajax({
//      url: "http://211.149.193.19:8080/api/customers",
//      success: function () {
//        console.log('哈哈，成功了')
//      },
//      error: function () {
//        console.log('出错啦！')
//      }
//    });
  });

  export default {
    data() {
      return {
        title: '演示Jquery原生写法'
      }
    },
    methods: {
      click() {
        console.log($)
//        console.log($('#datepicker').val())
      }
    },
    created() {
      //引入js文件（面向过程写法）
      func.test()
      //引入js文件（OOP写法）
      let base = new Base()
      base.test()
    },
    mounted() {

      console.log(this)

      //时间插件
      $('#datepicker').datepicker({
        language:'zh-CN',
        autoclose: true,
        todayHighlight:true,
        format: 'yyyy-mm-dd'
      });

      //select2插件
      $('#select2').select2();
    },
  }
</script>

<style>
</style>
