<template>
  <div class="login-box">
    <div class="login-logo">
      <b v-text="title"></b>
    </div>
    <div class="login-box-body">
      <form>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="账号">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="button" class="btn btn-primary btn-block btn-flat" @click="login">登录</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        title: '单页面应用登录',
        url: 'http://211.149.193.19:8080/api/customers'
      }
    },
    methods: {
      login () {
        let _this = this
        // 发送jsonp登录
        this.$http.get(this.url)
          .then((response) => {
            localStorage.username="root";
            _this.$router.push('/')
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
