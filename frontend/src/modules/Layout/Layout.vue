<template>
    <div id="wrapper">
        <div class="page tabbar js_show" style="max-width: 650px;margin: auto">
            <div class="page__bd" style="height: 100%;">
                <div class="weui-tab">
                    <div class="weui-tab__panel">
                        <router-view></router-view>
                    </div>
                    <Asider></Asider>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import 'iview/dist/styles/iview.css'
  import 'weui/dist/style/weui.min.css'
  import '../../assets/css/layout.css'
  import Asider from './Asider'
  import iView from 'iview'
  export default {
    name: 'wrapper',
    components: {
      'Asider': Asider,
      'i-affix': iView.Affix,
      'i-row': iView.Row,
      'i-col': iView.Col,
      'i-icon': iView.Icon,
    }
  }
</script>

<style>
</style>
