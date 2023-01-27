<template>
  <div class="w-full" >
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
        <div @click="toggleCreatePopup(true)" class="mx-2 w-8 h-8 text-center hover:border-blue-300 duration-300 cursor-pointer" >
          <van-icon name="add-o" size="30" />
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
          <th class="vcb-table-header">ឈ្មោះ</th>
          <th class="vcb-table-header">ទូរស័ព្ទ</th>
          <th class="vcb-table-header">អ៊ីមែល</th>
          <th class="vcb-table-header">អសយដ្ឋាន</th>
          <th class="vcb-table-header w-60" >ប្រតិបត្តិការផ្សេងៗ</th>
        </tr>
        <tr v-for="(record, index) in $store.getters[model.name+'/getRecords'].records" :key='index' class="vcb-table-row" >
          <td class="vcb-table-cell font-bold" >{{ index + 1 }}</td>
          <td  class="vcb-table-cell" >{{ record.lastname + " " + record.firstname }}</td>
          <td  class="vcb-table-cell" >{{ record.phone }}</td>
          <td  class="vcb-table-cell" >{{ record.email }}</td>
          <td class="vcb-table-cell" >{{ record.address }}</td>
          <td class="vcb-table-actions-panel" >
            <!-- New Button -->
            <!-- <div to="/user/new" class="vcb-action-button" >
              <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-4 h-4 mt-2 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div> -->
            <!-- New Button -->
            <div class="vcb-action-button  " >
              <van-icon name="edit" :size="20" class="my-1" @click="edit(record)" />
            </div>
            <!-- New Button -->
            <div class="vcb-action-button  " >
              <van-icon name="close" :size="20" class="my-1" @click="remove(record)" />
            </div>
          </td>
        </tr>
      </table>
    </div>
    <!-- Pagination of crud -->
    <div class="vcb-table-pagination">
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
    <!-- Form create -->
    <div class="vcb-pop-create font-ktr">
      <van-popup v-model:show="createPopToggle" class="p-8" >
        <div class="font-bold my-4 text-xl">បញ្ចូលព័ត៌មាន</div>
        <van-divider />
        <van-cell-group inset>
          <van-field
            v-model="record.create.lastname"
            label="ត្រកូល"
            placeholder="ត្រកូល"
          />
          <van-field
            v-model="record.create.firstname"
            label="ឈ្មោះ"
            placeholder="ឈ្មោះ"
          />
          <van-field v-model="record.create.phone" type="phone" label="ទូរសព្ទ័" placeholder="ទូរសព្ទ័" />
          <van-field
            v-model="record.create.email"
            label="អ៊ីមែល"
            placeholder="អ៊ីមែល"
          />
          <van-field
            v-model="record.edit.address"
            label="អសយដ្ឋាន"
            type="textarea" 
            row="1"
            autosize
            placeholder="អសយដ្ឋាន"
          />
        </van-cell-group>
        <van-button :loading="savingLoading" loading-text="រក្សារទុក..." type="primary" class="my-4 w-1/2" @click="saveRecord()" >ផ្ញើ</van-button>
      </van-popup>
    </div>
    <!-- Form edit -->
    <div class="vcb-pop-edit font-ktr">
      <van-popup v-model:show="editPopToggle" class="p-8" >
        <div class="font-bold my-4 text-xl">កែប្រែព័ត៌មាន</div>
          <van-field
            v-model="record.edit.lastname"
            label="ត្រកូល"
            placeholder="ត្រកូល"
          />
          <van-field
            v-model="record.edit.firstname"
            label="ឈ្មោះ"
            
            placeholder="ឈ្មោះ"
          />
          <van-field v-model="record.edit.phone" type="phone" label="ទូរសព្ទ័" placeholder="ទូរសព្ទ័" />
          <van-field
            v-model="record.edit.email"
            label="អ៊ីមែល"
            
            placeholder="អ៊ីមែល"
          />
          <van-field
            v-model="record.edit.address"
            label="អសយដ្ឋាន"
            type="textarea" 
            row="1"
            autosize
            placeholder="អសយដ្ឋាន"
          />
        <van-button :loading="editLoading" loading-text="រក្សារទុក..." type="primary" class="my-4 w-1/2" @click="updateRecord()" >រក្សារទុក</van-button>
      </van-popup>
    </div>
  </div>
</template>
<script>
import { ref } from 'vue'
import { Notify, Dialog , DatetimePicker, DropdownMenu, DropdownItem} from 'vant'
export default {
  components: {
  
  },
  setup(){
    return {
    }
  },
  name: "Client" ,
  data(){
    return {
      model: {
        name: "client" ,
        title: "អតិថិជន"
      },
      table: {
        data: [] ,
        columns: [] ,
        pagination: {

        }
      },
      createPopToggle : false ,
      editPopToggle: false ,
      record: {
        create: {
          id: 0 ,
          firstname: '' ,
          lastname: '' ,
          phone: '' ,
          email: '' ,
          address: ''
        },
        edit: {
          id: 0 ,
          firstname: '' ,
          lastname: '' ,
          phone: '' ,
          email: '' ,
          address: ''
        }
      },
      clearRecord: {
        id: 0 ,
        firstname: '' ,
        lastname: '' ,
        phone: '' ,
        email: '' ,
        address: ''
      },
      savingLoading: false,
      editLoading: false
    }
  },
  beforeMount(){
    this.$store.dispatch(this.model.name+'/list').then(res => {
      this.$store.commit(this.model.name+'/setRecords',res.data.records)
    }).catch( err => {
      console.log( err )
    })
  },
  mounted(){
    // console.log( this.axios )
    // console.log( this.$store.dispatch('user/getAllProducts') )
    // console.log( this.$store.state.record.all )
  },
  methods:{
    toggleCreatePopup(helper) {
      this.createPopToggle = helper === true ? helper : false 
    },
    toggleEditPopup(helper) {
      this.editPopToggle = helper === true ? helper : false 
    },
    saveRecord(){
      if( !this.validateData(this.record.create) ){
        return false
      }
      this.savingLoading = true 
      this.$store.dispatch(this.model.name+'/create', this.record.create ).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.record.create = this.clearRecord
        this.toggleCreatePopup(false)
        this.savingLoading = false 
      }).catch( err => {
        console.log( err )
      })
    },
    updateRecord(){
      if( !this.validateData(this.record.edit) ){
        return false
      }
      this.editLoading = true 
      this.$store.dispatch(this.model.name+'/update', this.record.edit ).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.record.edit = this.clearRecord
        this.toggleEditPopup(false)
        this.editLoading = false 
      }).catch( err => {
        console.log( err )
        this.editLoading = false
      })
    },
    validateData(record){
      // if( record.username == "" ){
      //   Notify({
      //     type: 'warning' ,
      //     message: 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។'
      //   })
      //   return false
      // }
      if( record.name == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលឈ្មោះ'
        })
        return false
      }
      if( record.phone == "" ){
        Notify({
          type: 'warning' ,
          message: 'សូមបញ្ចូលលេខទូរស័ព្ទ'
        })
        return false
      }
      // if( record.receiver_phone == "" ){
      //   Notify({
      //     type: 'warning' ,
      //     message: 'សូមបញ្ចូលអ៊ីមែល'
      //   })
      //   return false
      // }
      return true
    },
    remove(record){
      Dialog.confirm({
        title: "លុបព័ត៌មាន" ,
        message: "តើអ្នកចង់លុប មែនទេ?" ,
        confirmButtonText: "លុប" ,
        cancelButtonText: "ទេ"
      }).then( () => {
        console.log( "ok" )
        /**
         * onConfirm
         */
        this.$store.dispatch(this.model.name+'/delete',{
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
            message: "បរាជ័យលុប "
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
      this.record.edit = {
        id: record.id ,
        firstname: record.firstname ,
        lastname: record.lastname ,
        address: record.address ,
        phone: record.phone ,
        email: record.email 
      }
      this.toggleEditPopup(true)
    },
    /**
     * Get records
     */
    getRecords(){
      this.$store.dispatch(this.model.name+'/list').then(res => {
        this.$store.commit(this.model.name+'/setRecords',res.data.records)
      }).catch( err => {
        console.log( err )
      })
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
    @apply w-8 h-8 mx-2 text-center cursor-pointer hover:border-blue-500 hover:text-blue-500  duration-300;
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