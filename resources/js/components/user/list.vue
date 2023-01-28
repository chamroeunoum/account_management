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
          <input type="text" @keypress.enter="filterRecords(false)" v-model="table.search" class="bg-gray-100 px-2 h-9 my-1 w-full rounded border border-gray-200 focus:border-blue-600 hover:border-blue-600 " placeholder="ស្វែងរក" />
          <Icon size="27" class="absolute right-1 top-2 text-gray-400 hover:text-blue-700 cursor-pointer" @click="filterRecords(false)" >
            <n-icon>
              <Search20Regular />
            </n-icon>
          </Icon>
        </div>
        
      </div>
      <!-- Filter panel of crud -->
      <div class="filters-bar"></div>
    </div>
    <!-- Table of crud -->
    <div class="vcb-table-panel relative">
      <table class="vcb-table" >
        <tr class="vcb-table-headers" >
          <th class="vcb-table-header" >ល.រ</th>
          <th class="vcb-table-header">ឈ្មោះ</th>
          <th class="vcb-table-header">ឈ្មោះក្នុងប្រព័ន្ធ</th>
          <th class="vcb-table-header">លេខទូរស័ព្ទ</th>
          <th class="vcb-table-header">អ៊ីមែល</th>
          <th class="vcb-table-header text-right">ស្ថានភាពគណនី</th>
          <th class="vcb-table-header text-right w-40" >ប្រតិបត្តិការ</th>
        </tr>
        <tr v-for="(record, index) in table.records.matched" :key='index' class="vcb-table-row" >
          <td class="vcb-table-cell font-bold" >{{ index + 1 }}</td>
          <td class="vcb-table-cell" >{{ record.name }}</td>
          <td  class="vcb-table-cell" >{{ record.username }}</td>
          <td  class="vcb-table-cell" >{{ record.phone }}</td>
          <td class="vcb-table-cell" >{{ record.email }}</td>
          <td  class="vcb-table-cell text-right w-24" >
            <n-icon size="30" :class="'cursor-pointer ' + (record.active == 1 ? ' text-green-500 ' : ' text-gray-500 ') " @click="activateAccount(record)" :title="record.active == 1 ? 'គណនីនេះកំពុងបើកតំណើរការ' : 'គណនីនេះកំពុងត្រូវបានបិទមិនអាចប្រើប្រាស់បាន' " >
              <IosCheckmarkCircleOutline />
            </n-icon>
          </td>
          <td class="vcb-table-actions-panel text-right w-40" >
            <n-icon size="30" class="cursor-pointer text-blue-500" @click="$router.push('/'+model.name+'/'+record.id+'/detail')" title="ព័ត៌មានលម្អិតរបស់ម្ចាស់គណនី" >
              <ContactCard28Regular />
            </n-icon>
            <n-icon size="30" class="cursor-pointer text-blue-500" @click="showEditModal(record)" title="កែប្រែព័ត៌មាន" >
              <Edit20Regular />
            </n-icon>
            <n-icon size="30" class="cursor-pointer text-yellow-500" @click="inputPassword(record)" title="ប្ដូរពាក្យសម្ងាត់សម្រាប់គណនីនេះ" >
              <Key16Regular />
            </n-icon>
            <n-icon size="30" class="cursor-pointer text-red-500" @click="deleteAccount(record)" title="លុបគណនីនេះចោល" >
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
          <Icon size="40" class="text-red-600" >
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
    <!-- Form change password -->
    <div class="vcb-pop-edit font-ktr">
      <n-modal v-model:show="changePasswordModal.show" transform-origin="center">
        <n-card class="w-1/2 font-pvh text-xl" title="ប្ដូរពាក្យសម្ងាត់" :bordered="false" size="small">
          <template #header-extra>
            <n-button type="success" @click="changePassword(changePasswordModal.form)" >
              <template #icon>
                <n-icon>
                  <Save20Regular />
                </n-icon>
              </template>
              រក្សារទុក
            </n-button>
          </template>
          <!-- Form change password -->
          <div class="crud-create-form w-full border-t">
            <div class=" mx-auto p-4 flex-wrap">
              <div class="crud-form-panel w-full flex flex-wrap ">
                <n-form 
                  class="w-full text-left font-btb text-lg flex flex-wrap" 
                  :label-width="80"
                  :model="changePasswordModal.form"
                  :rules="changePasswordModal.rules"
                  size="large"
                  ref="formRef"
                >
                  <n-form-item label="ពាក្យសម្ងាត់ថ្មី" path="password" class="w-2/5 mr-8" >
                    <n-input type="password" show-password-on="mousedown" v-model:value="changePasswordModal.form.password" placeholder="ពាក្យសម្ងាត់ថ្មី" />
                  </n-form-item>
                </n-form>
                <div class="w-1/2 h-8"></div>  
              </div>
            </div>
          </div>
          <!-- End form change password -->
          <template #footer></template>
        </n-card>
      </n-modal>
    </div>
    <!-- End of change password -->
    <!-- Form create account -->
    <create-form v-bind:model="model" v-bind:show="createModal.show" :onClose="closeCreateModal"/>
    <!-- Form update account -->
    <update-form v-bind:model="model" v-bind:record="editRecord" v-bind:show="editModal.show" :onClose="closeEditModal"/>
  </div>
</template>
<script>
import { reactive } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

import { Switcher } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { IosCheckmarkCircleOutline, IosRefresh } from '@vicons/ionicons4'
import { TrashOutline, CloseCircleOutline } from '@vicons/ionicons5'
import { useDialog, useMessage, useNotification } from 'naive-ui'
import { Edit20Regular, Key16Regular, Save20Regular, Add20Regular, Search20Regular , ContactCard28Regular } from '@vicons/fluent'
/**
 * CRUD component form
 */
import CreateForm from './create.vue'
import UpdateForm from './update.vue'
export default {
  name: "User" ,
  components: {
    ,
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
    TrashOutline ,
    ContactCard28Regular
  },
  setup(){
    var store = useStore()
    const dialog = useDialog()
    const message = useMessage()
    const notify = useNotification()
    /**
     * Variables
     */    
    var model = reactive( {
      name: "user" ,
      title: "គណនី"
    })
    var table = reactive( {
      loading: false ,
      search: '' ,
      records: {
        all: [] ,
        matched: []
      },
      columns: {
        searchable: {
          username: '' ,
          firstname: '' ,
          lastname: '' ,
          email: '' ,
          phone: '' ,
          active: ''
        },
        format: {
          username: '' ,
          firstname: '' ,
          lastname: '' ,
          email: '' ,
          phone: '' ,
          active: ''
        }
      } ,
      pagination: {
        perPage: 2 ,
        page: 1 ,
        totalPages: 0 ,
        totalRecords: 0
      }
    })

    var changePasswordModal = reactive({
      show: false ,
      account: null ,
      form: {
        password: ''
      },
      rules: {
        password: {
          required: true,
          message: 'សូមបញ្ចូលពាក្យសម្ងាត់ថ្មី',
          trigger: [ 'blur']
        },
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
       * Clear time interval after calling
       */
      window.clearTimeout()
      table.loading = true
      store.dispatch(model.name+'/list',{
        search: table.search ,
        perPage: table.pagination.perPage ,
        page: table.pagination.page
      }).then(res => {
        table.records.all = table.records.matched = res.data.records
        table.pagination = res.data.pagination
        closeTableLoading()
      }).catch( err => {
        console.log( err )
      })
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

    function activateAccount(record){
      dialog.warning({
        title: "បិទ ឬ បើក គណនី" ,
        content: "តើអ្នកចង់ " + ( record.active == 1 ? "បិទ" : "បើក" )+ " គណនីនេះមែនទេ ?" ,
        positiveText: 'បាទ / ចាស',
        negativeText: 'ទេ',
        onPositiveClick: () => {
          store.dispatch( model.name+'/update',{
            id: record.id ,
            active: record.active == 1 ? 0 : 1
          }).then( res => {
            if( res.data.ok ){
              notify.success({
                title: 'ស្ថានភាពគណនី' ,
                description: 'ស្ថានភាពគណនីបានកែប្រែជោគជ័យ។' ,
                duration: 3000
              })
            }else{
              notify.error({
                title: 'ស្ថានភាពគណនី' ,
                description: 'មានបញ្ហាក្នុងពេលកែប្រែស្ថានភាពគណនី។' ,
                duration: 3000
              })
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
      username: "" ,
      firstname: "" ,
      lastname: "" ,
      phone: "" ,
      email: ""
    })
    function showEditModal(record){
      editRecord.id = record.id
      editRecord.username = record.username
      editRecord.firstname = record.person.firstname
      editRecord.lastname = record.person.lastname
      editRecord.phone = record.phone
      editRecord.email = record.email
      editRecord.person = record.person
      editModal.show = true
    }
    function closeEditModal(record){
      editModal.show = false
      getRecords()
    }
    function inputPassword(record){
      changePasswordModal.account = record
      changePasswordModal.form = {
        id: record.id ,
        password: record.password
      }
      changePasswordModal.show = true
    }
    function changePassword(form){
      if( form.password != "" && form.password != undefined && form.password != null ){
        store.dispatch( model.name+'/passwordChange',{
            id: form.id ,
            password: form.password 
          }).then( res => {
            if( res.data.ok ){
              notify.success({
                title: 'ប្ដូរពាក្យសំងាត់' ,
                description: 'បានកែប្រែពាក្យសំងាត់បានជោគជ័យ។' ,
                duration: 3000
              })
              changePasswordModal.show = false
              changePasswordModal.form = {
                id : 0 ,
                password: ''
              }
              getRecords()
            }else{
              notify.error({
                title: 'ប្ដូរពាក្យសំងាត់' ,
                description: 'មានបញ្ហាក្នុងពេលកែប្រែពាក្យសំងាត់។' ,
                duration: 3000
              })
            }
          }).catch( err => {
            message.error( err )
          })
      }else{
        notify.warning({
          title: 'ប្ដូរពាក្យសំងាត់' ,
          description: 'សូមបញ្ចូលពាក្យសំងាត់របស់អ្នក។' ,
          duration: 3000
        })
      }
    }

    function deleteAccount(record){
      dialog.warning({
        title: "លុបគណនី" ,
        content: "តើអ្នកចង់ លុប គណនីនេះមែនទេ ?" ,
        positiveText: 'បាទ / ចាស',
        negativeText: 'ទេ',
        onPositiveClick: () => {
          store.dispatch(model.name+'/delete',{id:record.id}).then( res => {
            if( res.data.ok ){
              notify.success({
                title: 'លុបទិន្នន័យ' ,
                description: 'លុបបានរួចរាល់។' ,
                duration: 3000
              })
              getRecords()
            }else{
              notify.success({
                title: 'លុបទិន្នន័យ' ,
                description: 'មានបញ្ហាក្នុងពេលលុបទិន្នន័យ។' ,
                duration: 3000
              })
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
     * Initial the data
     */
    getRecords()


    return {
      /**
       * Variables
       */
      model ,
      table ,
      changePasswordModal ,
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
      /**
       * Functions
       */
      activateAccount ,
      inputPassword ,
      changePassword ,
      deleteAccount
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