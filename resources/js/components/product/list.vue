<template>
  <div>
  <!-- Top action panel of crud -->
    <div class="flex title-bar border-b border-gray-200">
      <!-- Title of crud -->
      <div class="flex w-64 h-10 py-1 title " >
        <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <div class="leading-8 font-bold" v-html="model.title" ></div>
      </div>
      <!-- Actions button of the crud -->
      <div class="flex-grow action-buttons flex-row-reverse flex">
        <!-- New Button -->
        <!-- <router-link to="/package/create" class="mx-2 w-8 h-8 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <van-icon name="add-o" size="30" />
        </router-link> -->
        <div @click="$router.push('/receive')" class="mx-2 w-8 h-8 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <Icon :size="30">
            <Switcher />
          </Icon>
          <!-- <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-4 h-4 mt-2 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg> -->
        </div>
      </div>
      <!-- Filter panel of crud -->
      <div class="filters-bar"></div>
    </div>
    <!-- Table of crud -->
    <div class="vcb-table-panel ">
      <table class="vcb-table" >
        <tr class="vcb-table-headers" >
          <th class="vcb-table-header" >ល.រ</th>
          <th class="vcb-table-header" >កូត</th>
          <th class="vcb-table-header">សាខា</th>
          <th class="vcb-table-header">គោលដៅ</th>
          <th class="vcb-table-header">លេខអ្នកផ្ញើ</th>
          <th class="vcb-table-header">លេខអ្នកទទួល</th>
          <th class="vcb-table-header">ទំងន់ (គីឡូ)</th>
          <!-- <th class="vcb-table-header">វិមាឌ (បxណxក)</th> -->
          <th class="vcb-table-header">តម្លៃ (฿)</th>
          <th class="vcb-table-header">សម្គាល់</th>
          <!-- <th class="vcb-table-header w-60" >ប្រតិបត្តិការ</th> -->
        </tr>
        <tr v-for="(record, index) in $store.getters['product/getRecords'].records" :key='index' class="vcb-table-row" >
          <td class="vcb-table-cell font-bold" >{{ index + 1 }}</td>
          <td class="vcb-table-cell" >{{ record.code }}</td>
          <td  class="vcb-table-cell" >{{ record.from }}</td>
          <td  class="vcb-table-cell" >{{ record.to }}</td>
          <td  class="vcb-table-cell" >{{ record.sender_phone }}</td>
          <td class="vcb-table-cell" >{{ record.receiver_phone }}</td>
          <td  class="vcb-table-cell" >{{ record.weight }}</td>
          <!-- <td  class="vcb-table-cell" >{{ record.dimension }}</td> -->
          <td  class="vcb-table-cell" >{{ record.price }}</td>
          <td class="vcb-table-cell" >{{ record.note }}</td>
          <!-- <td class="vcb-table-actions-panel" >
          </td> -->
        </tr>
      </table>
    </div>
    <!-- Pagination of crud -->
    <div v-if="false" class="vcb-table-pagination">
      <!-- First -->
      <!-- Previous -->
      <div class="vcb-pagination-page" v-html='"<"' ></div>
      <!-- Pages (7) -->
      <div v-for='item in 7' :key='item' class="vcb-pagination-page" >{{ item }}</div>
      <!-- Next -->
      <div class="vcb-pagination-page" v-html='">"' ></div>
      <!-- Last -->
      <!-- Go to -->
      <!-- Total per page -->
    </div>
  </div>
</template>
<script>
import { reactive, ref } from 'vue'

import { Switcher } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
/**
 * CRUD component form
 */
import CreateForm from './create.vue'
import UpdateForm from './update.vue'
export default {
  components: {
    ,
    Switcher,
    Icon,
    CreateForm,
    UpdateForm
  },
  setup(){
    return {
    }
  },
  name: "Product" ,
  data(){
    return {
      model: {
        name: "product" ,
        title: "បញ្ញើ"
      },
      table: {
        data: [] ,
        columns: [] ,
        pagination: {

        }
      },
      createPopToggle : false ,
      product: {
        code: '' ,
        from: '' ,
        to: '' ,
        sender: '' ,
        receiver: '' ,
        weight: '' ,
        dimension: '' ,
        price: '' ,
        note: ''
      },
      savingLoading: false
    }
  },
  beforeMount(){
    this.$store.dispatch('product/list',{
      pagination: {
        perPage: 100 ,
        page: 1
      }
    }).then(res => {
      this.$store.commit('product/setRecords',res.data.records)
    }).catch( err => {
      console.log( err )
    })
  },
  mounted(){
    
  },
  methods:{
    onDecode(qrcodeString){
      console.log( qrcodeString )
    },
    saveProduct(){
      this.savingLoading = true 
    }
  }

}

</script>

<style scoped>
  .vcb-table-panel {
    @apply absolute right-4 left-4 mt-4 mb-16 top-12 bottom-0 overflow-auto;
  }
  .vcb-table {
    @apply w-full ;
  }
  .vcb-table tr.vcb-table-row {
    @apply border-b border-gray-100 text-left ;
  }
  .vcb-table tr.vcb-table-row td {
    @apply p-2;
  }
  .vcb-table-actions-panel {
    @apply flex flex-row-reverse ;
  }
  .vcb-table-actions-panel .vcb-action-button {
    @apply  rounded-full border border-gray-200 w-8 h-8 mx-2 text-center cursor-pointer hover:border-blue-500 hover:text-blue-500  duration-300;
  }
  .vcb-table-headers {
    @apply border-b border-gray-200;
  }
  .vcb-table-headers .vcb-table-header {
    @apply px-2 py-4 text-left ;
  }
  .vcb-table-pagination {
    @apply flex flex-row absolute bg-white right-0 bottom-0 border border-l p-3 ;
  }
  .vcb-pagination-page {
    @apply  rounded-full border border-gray-200 mx-1 leading-7 w-8 h-8 font-bold cursor-pointer hover:text-blue-500 hover:border-blue-500 duration-300;
  }
</style>