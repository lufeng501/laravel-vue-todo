<template>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{title}}
        <small>Optional description</small>
      </h1>
      <jg-breadcrumb v-bind:bread="bread"></jg-breadcrumb>
    </section>
    <br>
    <br>
    <div>
      {{returndata}}
      <jg-form v-model="returndata" v-bind:form="form"></jg-form>


      <!--<jg-select2></jg-select2>-->
    </div>

    <br>
    <br>

    <div>
      <i-alert type="success">消息提示示例</i-alert>
      <i-alert type="warning">消息提示示例</i-alert>
      <i-alert type="error">消息提示示例</i-alert>

    </div>

    <div>
      <i-table id="test-table" stripe :columns="columns" :data="data"></i-table>
    </div>
  </div>
</template>

<script>
  import JgBreadCrumb from '../../components/JgBreadCrumb'
  import JgForm from '../../components/JgForm'
//  import JgSelect2 from '../../components/JgSelect2'
  import iView from 'iview'
//  import 'iview/dist/styles/iview.css'
  export default {
    data() {
      return {
        title: '演示自定义组件',
        bread: ['后台', '组件', '首页'],
        form: 'test',
        returndata: '',
        columns: [
          {
            title: '姓名',
            key: 'name'
          },
          {
            title: '年龄',
            key: 'age'
          },
          {
            title: '地址',
            key: 'address'
          }
        ],
        data: [
          {
            name: '王小明',
            age: 18,
            address: '北京市朝阳区芍药居'
          },
          {
            name: '张小刚',
            age: 25,
            address: '北京市海淀区西二旗'
          },
          {
            name: '李小红',
            age: 30,
            address: '上海市浦东新区世纪大道'
          },
          {
            name: '周小伟',
            age: 26,
            address: '深圳市南山区深南大道'
          }
        ]
      }
    },
    components: {
      'jg-breadcrumb': JgBreadCrumb,
      'jg-form': JgForm,
//      'jg-select2': JgSelect2,
      'i-alert': iView.Alert,
      'i-table': iView.Table,
    }
  }
</script>

<style>
</style>
