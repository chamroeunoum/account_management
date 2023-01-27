<template>
  <div v-if="true" >
  <!-- Top action panel of crud -->
    <div class="flex title-bar border-b border-gray-200">
      <!-- Title of crud -->
      <div class="flex w-64 h-10 py-1 title " >
        <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <div class="leading-8 font-bold" v-html="'ព័ត៌មាន ' + model.title" ></div>
      </div>
      <!-- Actions button of the crud -->
      <div class="flex-grow action-buttons flex-row-reverse flex">
        <!-- New Button -->
        <div class="mt-1 ml-2">
          <n-button type="success" @click="showCreateModal()" >
            <template #icon>
              <n-icon>
                <Add20Regular />
              </n-icon>
            </template>
            បន្ថែម
          </n-button>
        </div>
        <div class="w-2/5 relative" >
          <n-input 
          type="text" 
          @keyup.enter="filterRecords(false)" 
          v-model:value="table.search" 
          clearable
          @clear="table.search='';filterRecords(false)"
          class="bg-gray-100 px-2 h-9 my-1 w-full  " placeholder="ស្វែងរក" 
          >
            <template #prefix>
              <n-icon>
                <Search20Regular />
              </n-icon>
            </template>
          </n-input>
          <!-- <Icon size="27" class="absolute right-1 top-2 text-gray-400 hover:text-blue-700 cursor-pointer" >
            <n-icon>
              <Search20Regular />
            </n-icon>
          </Icon> -->
        </div>
        
      </div>
      <!-- Filter panel of crud -->
      <div class="filters-bar"></div>
    </div>
    <!-- Table of crud -->
    <div class="vcb-table-panel relative">
      <table class="vcb-table" >
        <tr class="vcb-table-headers" >
          <th v-for="(column,index) in table.columns.format" :key="index" class="vcb-table-header" >{{ column.label }}</th>
          <th class="vcb-table-header text-right w-40" >ប្រតិបត្តិការ</th>
        </tr>
        <tr v-for="(record, index) in table.records.matched" :key='index' class="vcb-table-row" >
          <!-- <td class="vcb-table-cell font-bold" >{{ index + 1 }}</td> -->
          <td v-for="(column,index) in table.columns.format" :key="index" class="vcb-table-cell" v-html="record[column.field]" ></td>
          <td class="vcb-table-actions-panel text-right w-40" >
            <n-icon size="30" class="cursor-pointer text-blue-500" @click="showEditModal(record)" title="កែប្រែព័ត៌មាន" >
              <Edit20Regular />
            </n-icon>
            <n-icon size="30" class="cursor-pointer text-red-500" @click="deleteRecord(record)" title="លុបចោល" >
              <TrashOutline />
            </n-icon>
          </td>
        </tr>
      </table>
      <!-- Loading -->
      <div v-if="table.loading" class="table-loading absolute left-0 top-0 right-0 bottom-0 bg-white bg-opacity-75 ">
        <div class="spinner mt-24">
          <Icon size="40" class="animate-spin  text-blue-500" >
           <IosRefresh />
          </Icon><br/><br/>
          កំពុងអាន...
        </div>
        <div class="absolute top-3 right-3 " @click="closeTableLoading" >
          <Icon size="40" class="text-gray-400" >
           <CloseCircleOutline />
          </Icon>
        </div>
      </div>
    </div>
    <!-- Pagination of crud -->
    <div class="vcb-table-pagination">
      <!-- First -->
      <!-- Previous -->
      <div class="vcb-pagination-page" v-html='"<"' @click="previous()" ></div>
      <!-- Pages (7) -->
      <div v-for='item in table.pagination.totalPages' :key='item' class="vcb-pagination-page" @click="goTo(item)" >{{ item }}</div>
      <!-- Next -->
      <div class="vcb-pagination-page" v-html='">"' @click="next()" ></div>
      <!-- Last -->
      <!-- Go to -->
      <!-- Total per page -->
    </div>
    <!-- Form create account -->
    <create-form v-bind:model="model" v-bind:show="createModal.show" :onClose="closeCreateModal"/>
    <!-- Form update account -->
    <update-form v-bind:model="model" v-bind:record="editRecord" v-bind:show="editModal.show" :onClose="closeEditModal"/>
  </div>
</template>
<script>
import { reactive , ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import Vue3Barcode from 'vue3-barcode'
import { Switcher } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { IosCheckmarkCircleOutline, IosRefresh } from '@vicons/ionicons4'
import { TrashOutline, CloseCircleOutline } from '@vicons/ionicons5'
import { useDialog, useMessage } from 'naive-ui'
import { Edit20Regular, Key16Regular, Save20Regular, Add20Regular, Search20Regular } from '@vicons/fluent'
/**
 * CRUD component form
 */
import CreateForm from './create.vue'
import UpdateForm from './edit.vue'
export default {
  props: {
    model: {
      type: Object ,
      required: true
    } , // Object model contain property 'name' which is the name of the model and 'title' which is the title of the component to show to the user
    columns: {
      type: Array ,
      required: true 
    } , // Object contains the properties that are the name of the columns
    searchable: {
      type: Array ,
      required: true 
    } , // Object contains the properties that are the name of the columns which searchable (text)
    show: {
      type: Boolean ,
      default: false
    } ,
    perPage: {
      type: Number ,
      default: 5
    } , // The identified number of the total records show per page
    onShow: {
      type: Function ,
      default: () => {}
    } ,  // Toggle the visibility (show) of the listing component
    onClose: {
      type: Function ,
      default: () => {}
    } , // Toggle the visibility (hide) of the listing component
  },
  name: "ListComponent" ,
  components: {
    Vue3Barcode,
    Switcher,
    Add20Regular ,
    Icon,
    IosCheckmarkCircleOutline,
    CreateForm,
    IosRefresh ,
    CloseCircleOutline ,
    UpdateForm,
    Search20Regular ,
    Edit20Regular,
    Key16Regular,
    Save20Regular ,
    TrashOutline
  },
  setup(props){
    var store = useStore()
    const dialog = useDialog()
    const message = useMessage()
    /**
     * Variables
     */    
    var table = reactive( {
      loading: false ,
      search: '' ,
      records: {
        all: [] ,
        matched: []
      },
      columns: {
        searchable: props.searchable,
        format: props.columns
      },
      pagination: {
        perPage: props.perPage ,
        page: 1 ,
        totalPages: 0 ,
        totalRecords: 0
      }
    })

    function filterRecords(helper=true){
      if( helper ){
        table.records.matched = []
        if( table.search != "" ) {
          for(var index in table.records.all ){
            for(var field in table.records.all[index] ){
              if( (""+table.records.all[index][field]).includes( table.search ) !== false ) {
                table.records.matched.push( table.records.all[index] )
                break;
              }
            }
          }
        }
        if( table.records.matched.length <= 0 ) {
          table.records.matched = table.records.all
        }
      }else{
        setTimeout( goTo(1) , 500 )
      }
    }

    /**
     * Functions
     */
    function getRecords(){
      /**
       * Check the column searchable is defined 
       * And the columns are defined
       */
      if( Array.isArray( table.columns.format ) && 
        Array.isArray( table.columns.searchable ) &&
        table.columns.format.length > 0 && 
        table.columns.searchable.length > 0
      ){
        /**
         * Clear time interval after calling
         */
        window.clearTimeout()
        table.loading = true
        store.dispatch(props.model.name+'/list',{
          columns: table.columns.format ,
          search: {
            fields: table.columns.searchable,
            value: table.search
          },
          pagination: {
            perPage: table.pagination.perPage ,
            page: table.pagination.page
          }
        }).then(res => {
          table.records.all = table.records.matched = res.data.records
          table.pagination = res.data.pagination
          closeTableLoading()
        }).catch( err => {
          console.log( err )
        })
      }else {
        message.error('សូមបញ្ជាក់អំពីឈ្មោះក្បាលជួរឈរ នៃតារាង។')
      }
    }
    function closeTableLoading(){
      table.loading = false
    }
    /**
     * Pagination functions
     */
    function previous(){
      goTo( table.pagination.page <= 1 ? 1 : table.pagination.page - 1 )
    }
    function next(){
      goTo( table.pagination.page >= table.pagination.totalPages ? table.pagination.totalPages : table.pagination.page + 1 )
    }
    function goTo(page){
      table.pagination.page = page > table.pagination.totalPages ? table.pagination.totalPages : ( page < 1 ? 1 : page)
      getRecords()
    }
    function updatePerpage(perPage){
      table.pagination.perPage = perPage < 5 ? 5 : ( perPage > 100 ? 100 : perPgae )
      table.pagination.page = 1
      getRecords()
    }

    function deleteRecord(record){
      dialog.warning({
        title: "លុបព័ត៌មាន" ,
        content: "តើអ្នកចង់ លុប ព័ត៌មាននេះមែនទេ ?" ,
        positiveText: 'បាទ / ចាស',
        negativeText: 'ទេ',
        onPositiveClick: () => {
          store.dispatch(props.model.name+'/delete',{id:record.id}).then( res => {
          switch( res.status ){
            case 200 :
              message.success(res.data.message)
              getRecords()
              break;
          }
        }).catch( err => {
          message.error( err )
        })
        },
        onNegativeClick: () => {
        }
      })
    }

    /**
     * Create modal handling
     */
    var createModal = reactive({show:false})
    function showCreateModal(){
      createModal.show = true
    }

    function closeCreateModal(){
      createModal.show = false
      getRecords()
    }

    var editModal = reactive({show:false})
    var editRecord = reactive({
      id: 0 ,
      firstname: '' ,
      lastname: '' ,
      phone: '' ,
      email: '' ,
      address: ''
    })
    function showEditModal(record){
      /**
       * Clone the object record to editRecord
       */
      editRecord.id = record.id 
      editRecord.firstname = record.firstname 
      editRecord.lastname = record.lastname 
      editRecord.phone = record.phone 
      editRecord.email = record.email 
      editRecord.address = record.address 
      editModal.show = true
    }
    function closeEditModal(record){
      editModal.show = false
      getRecords()
    }

    /**
     * Clear record
     */
    function clearRecord() {
      // table.columns.format.reduce((o, key) => Object.assign(o, {[key]: '' }), {})
    }

    /**
     * Toggle showing list
     */
    var listShow = ref(props.show ? true : false)
    function toggle(){
      listShow.value = !listShow.value
      listShow.value ? props.onShow() : props.onClose()
    }

    /**
     * Initial the data
     */
    getRecords()
    listShow.value ? props.onShow() : props.onClose()

    console.log( listShow.value )

    return {
      /**
       * Variables
       */
      table ,
      toggle ,
      listShow ,
      clearRecord ,
      /**
       * Table
       */
      filterRecords ,
      /**
       * Pagination functions
       */
      updatePerpage ,
      goTo ,
      previous ,
      next ,
      /**
       * Loading overlay
       */
      closeTableLoading ,
      /**
       * Creating
       */
      createModal ,
      showCreateModal ,
      closeCreateModal ,     
      /**
       * Editing
       */
      editModal ,
      showEditModal ,
      closeEditModal , 
      editRecord ,
      deleteRecord
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