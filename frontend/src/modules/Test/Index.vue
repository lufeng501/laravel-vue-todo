<template>
  <div id="test-index">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          {{title}}
          <small>Optional description</small>
        </h1>
        <jg-breadcrumb title="我是父组件数据"></jg-breadcrumb>
      </section>

      <section class="content">

        <!--<div class="panel panel-primary">
          <div class="panel-heading">
            面板标题
          </div>
          <div class="panel-body">
            面板内容
          </div>
        </div>-->

        <div class="panel panel-primary">
          <div class="panel-heading">
            渲染数据
          </div>
          <div class="panel-body">
            <p>{{message}}</p>
            <p>{{html}}</p>
            <input class="form-control" type="text" name="" v-model="message" v-on:keyup.13="reverseMessage"/>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            渲染html内容
          </div>
          <div class="panel-body">
            <div v-html="html"></div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            绑定属性
          </div>
          <div class="panel-body">
            <div>
              <a target="_target" v-bind:href="url">百度一下</a>
            </div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            表达式运算
          </div>
          <div class="panel-body">
            {{ 1 + 100 }}
            <br>
            {{ message + url }}
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            绑定事件
          </div>
          <div class="panel-body">
            <button class="btn" v-on:click="reverseMessage">触发点击事件</button>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            过滤器
          </div>
          <div class="panel-body">
            {{ message | capitalize }}
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            模板渲染
          </div>
          <div class="panel-body">
            参照API管理后台代码
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            监听watch
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" v-model="question" placeholder="问题">
            <br>
            <br>
            <input type="text" class="form-control" v-model="form.question" placeholder="问题">
            <br>
            <br>
            {{answer}}
          </div>
        </div>

      </section>
    </div>
  </div>
</template>
<script>
  import JgBreadCrumb from '../../components/JgBreadCrumb'
  export default {
    name: 'test-index',
    data () {
      return {
        title: 'iveiw基本特性',
        message: 'abcdefg',
        html: '<h3>这里是html文本内容</h3>',
        url: 'http://baidu.com',
        seen: true,
        form: {question: ''},
        question: '',
        answer: ''
      }
    },
    watch: {
      // 如果 question 发生改变，这个函数就会运行
      question: function (newQuestion) {
        this.answer = '正在为你查找答案.....'
        console.log(newQuestion)
      },
      // 监控对象
      form: {
        handler: function (oldQuestion, newQuestion) {
          this.answer = '正在为你查找答案...'
          console.log(newQuestion)
        },
        deep: true
      }
    },
    methods: {
      reverseMessage () {
        this.message = this.message.split('').reverse().join('')
      }
    },
    filters: {
      capitalize: function (value) {
        if (!value) return ''
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
      }
    },
    components : {
      'jg-breadcrumb' : JgBreadCrumb
    }
  }
</script>
<style>
</style>
