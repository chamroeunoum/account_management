<template>
  <div>
  <!-- Top action panel of crud -->
    <div class="flex title-bar border-b border-gray-200">
      <!-- Title of crud -->
      <div class="flex w-64 h-10 py-1 title " >
        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <div class="leading-8 font-bold" v-html="model.title" ></div> -->
        <div class="mr-2">
          <n-button type="default" @click="$router.push('/'+model.name)" >
            <template #icon>
              <n-icon>
                <ArrowBackCircleOutline />
              </n-icon>
            </template>
            បន្ថែម
          </n-button>
        </div>
      </div>
      <!-- Actions button of the crud -->
      <div class="flex-grow action-buttons flex-row-reverse flex">
        <!-- New Button -->
        <!-- <div class="mt-1 ml-2">
          <n-button type="success" @click="showCreateModal()" >
            <template #icon>
              <n-icon>
                <Add20Regular />
              </n-icon>
            </template>
            បន្ថែម
          </n-button>
        </div>
        -->
        <!--
        <div class="w-2/5 relative" >
          <input type="text" @keypress.enter="filterRecords(false)" v-model="table.search" class="bg-gray-100 px-2 h-9 my-1 w-full rounded border border-gray-200 focus:border-blue-600 hover:border-blue-600 " placeholder="ស្វែងរក" />
          <Icon size="27" class="absolute right-1 top-2 text-gray-400 hover:text-blue-700 cursor-pointer" @click="filterRecords(false)" >
            <n-icon>
              <Search20Regular />
            </n-icon>
          </Icon>
        </div> -->
      </div>
      <!-- Filter panel of crud -->
      <!-- <div class="filters-bar"></div> -->
    </div>
    <!-- Table of crud -->
    <div class="vcb-table-panel relative">
      <div class="account-info">
        <div class="flex-none w-12 h-12">
            <img :src="profilePicture" class="w-full rounded-full" :alt="name" :title="name" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, computed } from 'vue'
import { useStore } from 'vuex'
import { useRouter, useRoute } from 'vue-router'
import Vue3Barcode from 'vue3-barcode'
import { Switcher } from '@vicons/carbon'
import { Icon } from '@vicons/utils'
import { IosCheckmarkCircleOutline, IosRefresh } from '@vicons/ionicons4'
import { TrashOutline, CloseCircleOutline, ArrowBackCircleOutline } from '@vicons/ionicons5'
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
    TrashOutline ,
    ContactCard28Regular,
    ArrowBackCircleOutline
  },
  setup(){
    const store = useStore()
    const route = useRoute()
    const router = useRouter()
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
    var record = reactive(null)

    /**
     * Functions
     */
    function getRecord(){
      /**
       * Clear time interval after calling
       */
      store.dispatch(model.name+'/read',{
        id: route.params.id
      }).then(res => {
        if( res.data.ok ){
          record = res.data.record
          console.log( record )
        }else{
          notify.error({
            title: '' ,
            description: '' ,
            duration: 3000
          })
        }
      }).catch( err => {
        console.log( err )
      })
    }

    const profilePicture = computed(() => {
      return record !== null && record.person !== null ? record.person.picture : "No picture"
    })

    const name = computed(() => {
      return record !== null && record.name !== null && record.name !== undefined ? record.name : "" 
    })

    /**
     * Initial the data
     */
    getRecord()


    return {
      /**
       * Variables
       */
      model ,
      record ,
      profilePicture ,
      name
      /**
       * Functions
       */
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