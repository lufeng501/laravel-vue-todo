<template>
    <div id="index-index" class="page__bd">
        <div class="weui-navbar">
            <div class="weui-navbar__item" v-bind:class="{ 'weui-bar__item_on' : modalIndex == 0 }" v-on:click="openModal(0)">
                <span v-text="orderLists[0][conditions['item_type']-1]['name']"></span>
                &nbsp;&nbsp;
                <i-icon type="chevron-down"></i-icon>
            </div>
            <div class="weui-navbar__item" v-bind:class="{ 'weui-bar__item_on' : modalIndex == 1 }" v-on:click="openModal(1)">
                <span v-text="orderLists[1][conditions['order_type']-1]['name']"></span>
                &nbsp;&nbsp;
                <i-icon type="chevron-down"></i-icon>
            </div>
        </div>
        <div class="weui-cells" style="margin-top: 50px">
            <a v-for="(item,index) in lists" class="weui-cell weui-cell_access" v-bind:href=" '#/New/' + item.id ">
                <div class="weui-cell__hd">
                    <i-icon style="color: #19be6b" type="leaf"></i-icon>
                </div>
                &nbsp;&nbsp;
                <div class="weui-cell__bd">
                    <p v-text="item.title"></p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
        </div>

        <!--模态框-->
        <i-modal v-model="modal" :closable="false">
            <div slot="header"></div>
            <div class="weui-cells" style="margin: -16px">
                <a v-for="(item,index) in orderLists[modalIndex]" v-on:click="setOrderType(modalIndex,item.type)" class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p v-text="item.name"></p>
                    </div>
                </a>
            </div>
            <div slot="footer"></div>
        </i-modal>

    </div>
</template>
<script>
  import iView from 'iview'

  const API_ROOT = process.env.API_ROOT

  export default {
    name: 'index-index',
    data () {
      return {
        modal: false,
        orderLists: [
          [
            {type : 1 , name : '全部清单'},
            {type : 2 , name : '未完成清单'},
            {type : 3 , name : '已完成清单'}
          ],
          [
            {type : 1 , name : '按名称排序'},
            {type : 2 , name : '按创建时间排序'},
            {type : 3 , name : '按更新时间排序'}
          ]
        ],
        conditions: {
          item_type : 2,
          order_type : 3
        },
        modalIndex: 0,
        lists: [],
      }
    },
    created() {
      this.getLists()
    },
    methods: {
      getLists() {
        let params = this.conditions
        // 获取待办事项
        this.$http.get(API_ROOT + '/todo/getTodoLists', {params : params})
          .then((response) => {
            let jsonRes = response.data
            console.log(jsonRes)
            if (jsonRes.state == 1) {
              this.lists = jsonRes.data
            } else {
            }
            this.submitting = false
          })
          .catch(function (response) {
            console.log(response)
          })
      },
      setOrderType(modalIndex,type) {
        if (modalIndex == 0) {
          this.conditions.item_type = type
        }
        if (modalIndex == 1) {
          this.conditions.order_type = type
        }
        this.modal = false
        this.getLists()
      },
      openModal(type) {
        this.modalIndex = type
        this.modal = true
      }
    },
    components: {
      'i-alert': iView.Alert,
      'i-icon': iView.Icon,
      'i-modal': iView.Modal,
      'i-input': iView.Input
    }
  }
</script>
<style>
</style>
