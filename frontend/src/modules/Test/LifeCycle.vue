<template>
  <div class="content-wrapper" id="lift-cycle">
    <h3>{{title}}</h3>
    <pre>{{msg}}</pre>
    <input type="text" v-model="msg" class="form-control" />
  </div>
</template>

<script>
  export default {
    data() {
      return {
        title: '演示组件实例的生命周期',
        msg: '双向数据绑定'
      }
    },
    beforeCreate() {
      console.log('beforeCreate')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    },
    created() {
      console.log('created')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    },
    beforeMount() {
      console.log('beforeMount')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    },
    mounted() {
      console.log('mounted')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    },
    beforeUpdate() {
      console.log('beforeUpdate..')
      console.log(this.$data)
      console.log(this.$el)
      console.log(this.$el===document.getElementById("lift-cycle"))
      console.log("==============")
    },
    updated() {
      console.log('updated..')
      console.log(this.$data)
      console.log(this.$el)
      console.log(this.$el===document.getElementById("lift-cycle"))
      console.log("==============")
    },
    beforeDestroy() {
      console.log('beforeDestroy')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    },
    destroyed() {
      console.log('destroyed')
      console.log(this.$data)
      console.log(this.$el)
      console.log("==============")
    }
  }
</script>
<style>
</style>
