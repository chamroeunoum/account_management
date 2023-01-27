<template>
  <div class="flex flex-wrap justify-around" >
    <div class="flex flex-wrap w-full h-12 border-b  font-pvh ">
      <div class="sct-transaction-date w-1/2 flex leading-10 font-dangrek text-xl">{{ sctTransactionDate }}</div>
      <div class="sct-transaction-new-package flex flex-row-reverse w-1/2">
        <div @click="toggleCreatePopup(true)" class="mx-2 w-8 h-8 mt-1 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <van-icon name="add-o" :size="32" class="hover:text-blue-600 " />
          <!-- <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-4 h-4 mt-2 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg> -->
        </div>
        <div @click="$router.push('/package')" class="mx-2 ml-4 my-1 w-8 h-8 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <Icon :size="30">
            <Table />
          </Icon>
          <!-- <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-4 h-4 mt-2 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg> -->
        </div>
        <div class="w-1/2" >
          <input type="text" @keyup="filterProducts" v-model="search.value" class="bg-gray-100 px-2 h-8 my-1 w-full rounded border border-gray-200 focus:border-blue-600 hover:border-blue-600 " placeholder="ស្វែងរកឥវ៉ាន់តាមលេខកូដ" />
        </div>
        <div class="w-1/4 leading-10" >
          ចំនូនឥវ៉ាន់សរុប ៖ <strong class="font-dangrek text-blue-500 mx-2 text-xl ">{{ this.products.all.length }}</strong> ដុំ 
        </div>
        <div class="w-1/4 leading-10" >
          តម្លៃសរុប ៖ <strong class="font-dangrek text-blue-500 mx-2 text-xl">{{ totalPrice }}</strong> ฿
        </div>
      </div>
    </div>
    <van-divider class="w-full text-2xl font-pvh" >កញ្ចប់ឥវ៉ាន់</van-divider>
    <div v-for="(record, index) in this.products.matched" :key="index" class="font-ktr w-1/6 relative flex flex-wrap text-left border border-gray-300 bg-gray-50 m-4 p-4 shadow hover:shadow-xl" >
      <div class="w-full text-xl mt-4 mb-2 font-dangrek text-blue-500" >{{ record.code }}</div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="location-o" color="#1989fa"/>
        {{ record.from }}
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="location" color="#1989fa"/>
        {{ record.to }}
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="phone-o" color="#1989fa"/>
        {{ record.sender_phone }}
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="phone" color="#1989fa"/>
        {{ record.receiver_phone }}
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="bag-o" color="#1989fa"/>
        {{ record.weight }} គីឡូ
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="send-gift-o" color="#1989fa"/>
        {{ record.dimension }}
      </div>
      <div class="w-1/2 font-extrabold my-1" >
        <van-icon name="paid" color="#1989fa"/>
        {{ record.price }} ฿
      </div>
      <div class="w-full font-extrabold mt-1 mb-1" >
        <van-icon name="records" color="#1989fa"/>
        {{ record.note }}
      </div>
      <div class="w-1/2 font-extrabold my-1 mx-auto" >
        <qrcode-vue :value="record.code" :size="60" level="H" class="mx-auto" />
      </div>
      
      <div class="mx-2 w-4 h-4 mt-1 text-center text-red-500 cursor-pointer absolute top-1 right-1" >
        <van-icon name="close" :size="20" class="" @click="remove(record)" />
      </div>
      <div class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 cursor-pointer absolute top-1 right-7" >
        <van-icon name="edit" :size="20" class="" @click="edit(record)" />
      </div>
      <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 cursor-pointer absolute top-1 right-12" >
        <van-icon name="orders-o" @click="print(record)" />
      </div> -->
      <!-- <div class="mx-2 w-4 h-4 mt-1 text-center text-blue-500 absolute left-2 top-4 " >
        <van-icon name="logistics" :size="20" class="" />
      </div>
      <div class="mx-2 w-4 h-4 mt-1 text-center text-green-500 absolute left-8 top-4 " >
        <van-icon name="passed" :size="20" class="" />
      </div> -->
    </div>
    <!-- Form create -->
    <div class="vcb-pop-create font-ktr">
      <van-popup v-model:show="createPopToggle" class="p-8" >
        <div class="font-bold my-4 text-xl">ព័ត៌មានបញ្ញើ</div>
        <!-- Support Khmer -->
        <!-- <qrcode-stream @decode="onDecode" ></qrcode-stream> -->
        <!-- Support Khmer -->
        <!-- <qrcode-vue value="អ៊ុំ ចំរើន" size="300" level="H" /> -->
        <!-- Not support khmer -->
        <!-- <vue3-barcode value="Chamroeun OUM" :height="50" /> -->
        <van-divider />
        <div class="w-full my-2 h-12">
            <n-auto-complete :options="clientfilters" v-model:value="client.record" placeholder="Email" />
          </div>  
        <van-cell-group inset>
          
          <!-- <van-field v-model="product.create.code" label="លេខកូដ" placeholder="លេខកូតសម្គាល់ប្រអប់ឥវ៉ាន់" /> -->
          <van-field
            v-model="product.create.from"
            label="ផ្ញើចេញពី"
            type="textarea"
            placeholder="អសយដ្ឋានក្រុមហ៊ុន (សាខា)"
            rows="1"
            autosize
            disabled
          /> 
          <van-field
            v-model="product.create.to"
            label="គោលដៅ"
            type="textarea"
            placeholder="គោលដៅដែលដែលត្រូវទៅ"
            rows="1"
            autosize
          />
          <!-- <van-dropdown-menu>
            <van-dropdown-item v-model="member" :options="option1" />
          </van-dropdown-menu> -->
          <van-field v-model="product.create.sender_phone" type="phone" label="លេខអ្នកផ្ញើរ" placeholder="លេខអ្នកផ្ញើរ" />
          <van-field v-model="product.create.receiver_phone" type="phone" label="លេខអ្នកទទួល" placeholder="លេខអ្នកទទួល" />
          <van-field v-model="product.create.weight" type="number" label="ទំងន់ (គីឡូ)" placeholder="ទំងន់ (គីឡូ)" />
          <van-divider>ទំហំប្រអប់</van-divider>
          <van-radio-group v-model="product.create.dimension" direction="horizontal" class="mx-4 my-6" label="ទំហំប្រអប់" placeholder="ទំហំប្រអប់" >
            <van-radio name="60x40x20">60x40x20</van-radio>
            <van-radio name="60x60x40">60x60x40</van-radio>
            <van-radio name="20x10x10">20x10x10</van-radio>
            <van-radio name="20x5x10">20x5x10</van-radio>
          </van-radio-group>
          <van-divider />
          <van-field :step="1" v-model="product.create.price" type="number" label="តម្លៃ" placeholder="តម្លៃ" />
          <van-field
            v-model="product.create.note"
            label="សម្គាល់"
            type="textarea"
            placeholder="សម្គាល់ផ្សេងៗ"
            rows="3"
            autosize
          />
        </van-cell-group>
        <van-button :loading="savingLoading" loading-text="រក្សារទុក..." type="primary" class="my-4 w-1/2" @click="saveProduct()" >ផ្ញើ</van-button>
      </van-popup>
    </div>
    <!-- Form edit -->
    <div class="vcb-pop-edit font-ktr">
      <van-popup v-model:show="editPopToggle" class="p-8" >
        <div class="font-bold my-4 text-xl">កែប្រែព័ត៌មានបញ្ញើ</div>
        <!-- Support Khmer -->
        <!-- <qrcode-stream @decode="onDecode" ></qrcode-stream> -->
        <!-- Support Khmer -->
        <!-- <qrcode-vue value="អ៊ុំ ចំរើន" size="300" level="H" /> -->
        <!-- Not support khmer -->
        <!-- <vue3-barcode value="Chamroeun OUM" :height="50" /> -->
        <van-divider />
        <van-cell-group inset>
          <!-- <van-field v-model="product.edit.code" label="លេខកូដ" placeholder="លេខកូតសម្គាល់ប្រអប់ឥវ៉ាន់" /> -->
          <van-field
            v-model="product.edit.from"
            label="ផ្ញើចេញពី"
            type="textarea"
            placeholder="អសយដ្ឋានក្រុមហ៊ុន (សាខា)"
            rows="1"
            autosize
            disabled
          /> 
          <van-field
            v-model="product.edit.to"
            label="គោលដៅ"
            type="textarea"
            placeholder="គោលដៅដែលដែលត្រូវទៅ"
            rows="1"
            autosize
          />
          <van-field v-model="product.edit.sender_phone" type="phone" label="លេខអ្នកផ្ញើរ" placeholder="លេខអ្នកផ្ញើរ" />
          <van-field v-model="product.edit.receiver_phone" type="phone" label="លេខអ្នកទទួល" placeholder="លេខអ្នកទទួល" />
          <van-field v-model="product.edit.weight" type="number" label="ទំងន់" placeholder="ទំងន់" />
          <van-divider>ទំហំប្រអប់</van-divider>
          <van-radio-group v-model="product.edit.dimension" direction="horizontal" class="mx-4 my-6" label="ទំហំប្រអប់" placeholder="ទំហំប្រអប់" >
            <van-radio name="60x40x20">60x40x20</van-radio>
            <van-radio name="60x60x40">60x60x40</van-radio>
            <van-radio name="20x10x10">20x10x10</van-radio>
            <van-radio name="20x5x10">20x5x10</van-radio>
          </van-radio-group>
          <van-divider />
          <van-field :step="1" v-model="product.edit.price" type="number" label="តម្លៃ" placeholder="តម្លៃ" />
          <van-field
            v-model="product.edit.note"
            label="សម្គាល់"
            type="textarea"
            placeholder="សម្គាល់ផ្សេងៗ"
            rows="3"
            autosize
          />
        </van-cell-group>
        <van-button :loading="editLoading" loading-text="រក្សារទុក..." type="primary" class="my-4 w-1/2" @click="updateProduct()" >រក្សារទុក</van-button>
      </van-popup>
    </div>
  </div>
</template>

<script>
import QrcodeVue from 'qrcode.vue'
import { Notify, Dialog , DatetimePicker, DropdownMenu, DropdownItem} from 'vant'
import { Table } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { defineComponent, ref, reactive, computed } from 'vue'

export default {
  setup () {
    const client = reactive({
      records: [
        {
          label: 'ចាន់ ភោគ',
          value: 1
        },
        {
          label: 'ជាវ ដាវ',
          value: 2
        },
        {
          label: 'មេត ហ្វុង',
          value: 3
        }
      ] ,
      record: ''
    })
    return {
      client,
      clientfilters: computed( () => {
        if( client.record !== "" ) return client.records.filter( c => c.label.indexOf( client.record ) != -1 )
        return []
      })
    }
  },
  components: {
    QrcodeVue,
    Table,
    Icon
  },
  data(){
    return {
      
      createPopToggle : false ,
      editPopToggle: false ,
      products: {
        all : [] ,
        matched : []
      } ,
      product: {
        create: {
          id: 0 ,
          client_id: 0 ,
          code: '' ,
          from: 'បាងកក' ,
          to: '' ,
          sender_phone: '' ,
          receiver_phone: '' ,
          weight: '' ,
          dimension: '60x40x20' ,
          price: '' ,
          note: ''
        },
        edit: {
          id: 0 ,
          client_id: 0 ,
          code: '' ,
          from: 'បាងកក' ,
          to: '' ,
          sender_phone: '' ,
          receiver_phone: '' ,
          weight: '' ,
          dimension: '60x40x20' ,
          price: '' ,
          note: ''
        }
      },
      clearProduct: {
        id: 0 ,
        client_id: 0 ,
        code: '' ,
        from: 'បាងកក' ,
        to: '' ,
        sender_phone: '' ,
        receiver_phone: '' ,
        weight: '' ,
        dimension: '60x40x20' ,
        price: '' ,
        note: ''
      },
      savingLoading: false ,
      editLoading: false ,
      search: {
        value: ''
      }
    }
  },
  computed:{
    totalPrice(){
      let total = 0 
      for(var i in this.products.all ){
        total += this.products.all[i].price
      }
      return total
    },
    sctTransactionDate(){
      let now = new Date()
      return now.getFullYear() + "-" + now.getMonth() + "-" + now.getDay()
    }
  },
  beforeMount(){
    this.getRecords()
  },
  mounted(){
    
  },
  methods: {
    remove(record){
      Dialog.confirm({
        title: "លុបព័ត៌មានបញ្ញើ" ,
        message: "តើអ្នកចង់លុបបញ្ញើ នេះមែនទេ?" ,
        confirmButtonText: "លុប" ,
        cancelButtonText: "ទេ"
      }).then( () => {
        console.log( "ok" )
        /**
         * onConfirm
         */
        this.$store.dispatch('product/delete',{
          id: record.id
        }).then( res => {
          switch( res.status ){
            case 200 : 
            Notify({
              type: "success" ,
              message: "បានលុបរួចរាល់។"
            })
            this.getRecords()
            break;
          }
        }).catch( err => {
          console.log( "No" )
          Notify({
            type: "danger" ,
            message: "បរាជ័យលុបបញ្ញើ។ "
          })
        })
      }).catch( () => {
        /**
         * onCancel
         */
      })
      /**
       * Confirm before delete the package and need a reason to delete the information
       */
    },
    edit(record){
      this.product.edit = {
        id: record.id ,
        client_id: record.client_id ,
        code: record.code ,
        from: record.from ,
        to: record.to ,
        sender_phone: record.sender_phone ,
        receiver_phone: record.receiver_phone ,
        weight: parseInt( record.weight ) ,
        dimension: record.dimension ,
        price: parseFloat( record.price ),
        note: record.note
      }
      this.toggleEditPopup(true)
    },
    print(record){

    },
    updateProduct(){
      if( !this.validateData(this.product.edit) ){
        return false
      }
      this.editLoading = true 
      this.$store.dispatch('product/update', this.product.edit ).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.product.edit = this.clearProduct
        this.toggleEditPopup(false)
        this.editLoading = false 
      }).catch( err => {
        console.log( err )
        this.editLoading = false
      })
    },
    filterProducts(){
      this.products.matched = []
      for(var i in this.products.all ){
        if( this.products.all[i].code.indexOf( this.search.value ) != -1 ) {
          this.products.matched.push( this.products.all[i] )
        }
      }
      console.log( this.products.matched )
      if( this.products.matched.length <= 0 ) {
        this.products.matched = this.products.all
      }
    },
    validateData(record){
      if( record.from == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបំពេញព័ត៌មានអំពីកន្លែងដាក់ផ្ញើ។'
        })
        return false
      }
      if( record.to == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបំពេញព័ត៌មានអំពីគោលដៅរបស់ឥវ៉ាន់។'
        })
        return false
      }
      if( record.sender_phone == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលលេខអ្នកផ្ញើ។'
        })
        return false
      }
      if( record.receiver_phone == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលលេខអ្នកទទួល។'
        })
        return false
      }
      if( record.dimension == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ជាក់អំពីទំហំនៃការវេចខ្ចប់។'
        })
        return false
      }
      if( record.price == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ជាក់អំពីតម្លៃ។'
        })
        return false
      }
      return true
    },
    toggleCreatePopup(helper) {
      this.createPopToggle = helper === true ? helper : false 
    },
    toggleEditPopup(helper) {
      this.editPopToggle = helper === true ? helper : false 
    },
    saveProduct(){
      if( !this.validateData(this.product.create) ){
        return false
      }
      this.savingLoading = true 
      this.$store.dispatch('product/create', this.product.create ).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.product.create = this.clearProduct
        this.toggleCreatePopup(false)
        this.savingLoading = false 
      }).catch( err => {
        console.log( err )
      })
      
      // .then( res => {
      //   console.log( res )
      // }).catch( err => {
      //   console.log( err )
      // })
    },
    /**
     * Get records
     */
    getRecords(){
      this.$store.dispatch('product/list').then(res => {
        this.$store.commit('product/setRecords',res.data.records)
        this.products.all = this.products.matched = this.$store.getters['product/getRecords'].records
      }).catch( err => {
        console.log( err )
      })
    }
  }
  
}
</script>