<template>
  <div class="weui-tabbar">
    <a href="#/" class="weui-tabbar__item weui-bar__item_on">
      <i-icon class="weui-tabbar__label" type="android-menu"></i-icon>
      <p class="weui-tabbar__label">清单</p>
    </a>
    <a href="#/New" class="weui-tabbar__item">
      <i-icon class="weui-tabbar__label" type="android-add-circle"></i-icon>
      <p class="weui-tabbar__label">添加</p>
    </a>
    <!--<a href="#" class="weui-tabbar__item">
      <i-icon class="weui-tabbar__label" type="android-person"></i-icon>
      <p class="weui-tabbar__label">我</p>
    </a>-->
  </div>
</template>

<script>
  import iView from 'iview'
  export default {
    name: 'aside',
    created() {
      // ...
    },
    components: {
      'i-icon': iView.Icon,
    }
  }
</script>

