<template>
  <div class="flex flex-wrap justify-around" >    
      <div class="printing-dialog absolute left-0 top-0 right-0 bottom-0 bg-white ">
        <div id="receiptPrintArea" class="font-ktr relative flex flex-wrap text-left  m-4 p-4 mx-auto mt-5" style="width: 322.36px; " >
          <div class="w-full font-extrabold my-1 text-center" >
            <img src="./../../assets/logo.png" class=" rounded-full w-20 mx-auto" alt="SCT Logo" title="SCT Logo" />
            <div >
              ក្រុមហ៊ុនដឹកជញ្ជូន សូនីកម្ពុជា<br/>(+៦៦) ៨៣ ២២២២ ៤៩៦ / (+៦៦) ៨៨ ៨៨៥៧ ៩៤១<br/>១២០ ៤៣៣ ភេតបូរី ផ្លូវ ១៥, ឋាននផាយាថៃ, រាចាថាវី, បាងកក ១០៤០០
            </div>
          </div>
          <div class="w-full text-xl mt-4 mb-2 font-dangrek text-center" >{{ record.code }}</div>
          <div class="w-full font-extrabold my-1" >
            <van-icon name="location-o" color="#1989fa"/>
            ចេញពី&emsp;៖ {{ record.from }}
          </div>
          <div class="w-full font-extrabold my-1" >
            <van-icon name="location" color="#1989fa"/>
            គោលដៅ&nbsp;៖ {{ record.to }}
          </div>
          <div class="w-1/2 font-extrabold my-1" >
            <van-icon name="phone-o" color="#1989fa"/>
            ទូរស័ព្ទអ្នកផ្ញើ ៖
          </div>
          <div class="w-1/2 font-extrabold my-1" >
            <van-icon name="phone" color="#1989fa"/>
            ទូរស័ព្ទអ្នកទទួល ៖
          </div>
          <div class="w-1/2 font-extrabold my-1" >
            {{ record.sender_phone }}
          </div>
          <div class="w-1/2 font-extrabold my-1" >
            {{ record.receiver_phone }}
          </div>
          <div class="w-full font-extrabold my-1" >
            ចំនួនកញ្ចប់ ៖ {{ record.total_packages }}
          </div>
          <!-- <div class="w-1/2 font-extrabold my-1" >
            <van-icon name="bag-o" color="#1989fa"/>
            {{ record.weight }} គីឡូ
          </div> -->
          <!-- <div class="w-1/2 font-extrabold my-1" >
            <van-icon name="send-gift-o" color="#1989fa"/>
            {{ record.dimension }}
          </div> -->
          <!-- <div :class="'w-full font-extrabold my-1 ' + ( record.payment_status == 1 ? 'text-green-600 ' : 'text-red-600 ' ) " >
            <van-icon name="paid" />
            {{ record.price }} ฿ - {{ record.payment_status == 1 ? "បង់រួច" : "មិនទាន់បង់" }}
          </div> -->
          <div class="w-full font-extrabold mt-1 mb-1 py-2 " >
            {{ record.note }}
          </div>
          <!-- <div v-if="record.client!==undefined" title="ឈ្មោះភ្ញៀវ" class="w-1/2 font-extrabold mt-2 mx-auto" >
            <div class="h-16 w-full leading-10 flex flex-wrap">
              <Icon size="30" class="text-blue-500 " >
                <MdMan />
              </Icon>
              <div class="h-8 ">{{ ( record.client.lastname !== null ? record.client.lastname + " " : "" ) + ( record.client.firstname !== null ? record.client.firstname : "" ) }}</div>
            </div>
          </div> -->
          <div class="w-1/2 font-extrabold mt-2 mx-auto" >
            <qrcode-vue :value="record.to+','+record.code+','+record.total_packages+','+record.sender_phone+','+record.receiver_phone" :size="120" level="H" class="mx-auto" />
          </div>
        </div>
        <!-- printing actions -->
        <!-- <div id="buttonPrintReceipt" class="buttonPrintReceipt mx-2 w-4 h-4 mt-1 text-center text-green-500 cursor-pointer absolute top-2 right-24" @click="printReceipt()" >
          <icon size="40" class="" @click="showPrintReceipt(record)" >
            <Print24Regular />
          </icon>
        </div>
        <div id="buttonClosePrinting" class="buttonClosePrinting mx-2 w-4 h-4 mt-1 text-center text-red-500 cursor-pointer absolute top-2 right-7" @click="closePrintReceipt()">
          <van-icon name="close" :size="40" class=""  />
        </div> -->
        <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-yellow-500 cursor-pointer absolute top-1 right-16" >
          <icon size="20" class="" @click="showPrintReceipt(record)" >
            <Print24Regular />
          </icon>
        </div> -->
      </div>
    <!-- </teleport> -->
  </div>
</template>

<script>
import QrcodeVue from 'qrcode.vue'
import { Table, Save } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { reactive } from 'vue'
import { MdMan } from '@vicons/ionicons4'
import { ArrowBackIosNewRound } from '@vicons/material'
import { Box16Regular, Print24Regular } from '@vicons/fluent'
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'

export default {
  setup () {
    let store = useStore()
    let route = useRoute()
    let record = reactive({
      id: 0 ,
      client_id: null ,
      code: '' ,
      from: 'បាងកក' ,
      to: '' ,
      sender_phone: '' ,
      receiver_phone: '' ,
      weight: '' ,
      dimension: '60x40x20' ,
      price: '' ,
      note: '',
      payment_status: 1 ,
      total_packages: 1 ,
      branch_id : 1 ,
      created_by: 0 ,
    })
    let model = {
      name: 'product' ,
      title: "បញ្ញើ"
    }

    /**
     * Get records
     */
    function getRecord(){
      if( route.params.id !== undefined && route.params.id > 0){
        store.dispatch(model.name+'/readUnauth',{
          id: route.params.id
        }).then(res => {
          store.commit(model.name+'/setRecord',res.data.record)
          // record = store.getters[model.name+'/getRecord']
          record.to = store.getters[model.name+'/getRecord'].to
          record.from = store.getters[model.name+'/getRecord'].from
          record.code = store.getters[model.name+'/getRecord'].code
          record.sender_phone = store.getters[model.name+'/getRecord'].sender_phone
          record.receiver_phone = store.getters[model.name+'/getRecord'].receiver_phone
          record.total_package = store.getters[model.name+'/getRecord'].total_package
          record.payment_status = store.getters[model.name+'/getRecord'].payment_status
          record.price = store.getters[model.name+'/getRecord'].price
          record.weight = store.getters[model.name+'/getRecord'].weight
          record.dimension = store.getters[model.name+'/getRecord'].dimension
        }).catch( err => {
          console.log( err )
        })
      }else{
        /**
         * Package id not specify
         */
      }
    }

    /**
     * Read location that guest request information of the package
     */

    getRecord()

    return {
      /**
       * Variables
       */
      record ,
      model ,
      /**
       * Functions
       */
      getRecord ,
    }
  },
  components: {
    MdMan ,
    QrcodeVue,
    Table,
    Icon,
    Save, 
    ArrowBackIosNewRound,
    Box16Regular,
    Print24Regular
  },
  data(){
    return {
    }
  },
  computed:{
    // sctTransactionDate(){
    //   let now = new Date()
    //   return now.getFullYear() + "-" + ( now.getMonth() + 1 ) + "-" + now.getDate()
    // },
  },
}
</script>

<style >
  @media print {
    body * {
      visibility: hidden;
    }
    #receiptPrintArea, #receiptPrintArea * {
      visibility: visible;
    }
    #receiptPrintArea {
      /* position: absolute;
      left: 0;
      top: 0; */
    }
  }
</style>