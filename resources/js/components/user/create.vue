<template>
  <!-- Form edit account -->
    <div class="vcb-pop-create font-ktr">
      <n-modal v-model:show="show" :on-after-leave="onClose" transform-origin="center">
        <n-card class="w-1/2 font-pvh text-xl" :title="'បន្ថែម ' + model.title" :bordered="false" size="small">
          <template #header-extra>
            <n-button type="success" @click="create()" >
              <template #icon>
                <n-icon>
                  <Save20Regular />
                </n-icon>
              </template>
              រក្សារទុក
            </n-button>
          </template>
          <!-- Form edit account -->
          <div class="crud-create-form w-full border-t">
            <div class=" mx-auto p-4 flex-wrap">
              <div class="crud-form-panel w-full flex flex-wrap ">
                <n-form 
                  class="w-full text-left font-btb text-lg flex flex-wrap" 
                  :label-width="80"
                  :model="record"
                  :rules="rules"
                  size="large"
                  ref="formRef"
                >
                  <n-form-item label="ឈ្មោះក្នុងប្រព័ន្ធ" path="username" class="w-4/5 mr-8" >
                    <n-input v-model:value="record.username" placeholder="ឈ្មោះក្នុងប្រព័ន្ធ" @blur="checkUsername" />
                  </n-form-item>
                  <n-form-item label="ត្រកូល" path="lastname" class="w-4/5 mr-8" >
                    <n-input v-model:value="record.lastname" placeholder="នាមត្រកូល" />
                  </n-form-item>
                  <n-form-item label="ឈ្មោះ" path="firstname" class="w-4/5 mr-8" >
                    <n-input v-model:value="record.firstname" placeholder="នាមខ្លួន" />
                  </n-form-item>
                  <n-form-item label="អ៊ីមែល" path="email" class="w-4/5 mr-8" >
                    <n-input v-model:value="record.email" placeholder="អ៊ីមែល" @blur="checkEmail" />
                  </n-form-item>
                  <n-form-item label="ទូរស័ព្ទ" path="phone" class="w-4/5 mr-8" >
                    <n-input v-model:value="record.phone" placeholder="ទូរស័ព្ទ" @blur="checkPhone" />
                  </n-form-item>
                  <n-form-item label="ពាក្យសម្ងាត់" path="password" class="w-4/5 mr-8" >
                    <n-input type="password" show-password-on="mousedown" v-model:value="record.password" placeholder="ពាក្យសម្ងាត់" />
                  </n-form-item>
                </n-form>
                <div class="w-1/2 h-8"></div>  
              </div>
            </div>
          </div>
          <!-- End form edit account -->
          <template #footer></template>
        </n-card>
      </n-modal>
    </div>
    <!-- End of edit account -->
</template>
<script>
import { reactive } from 'vue'
import { useStore } from 'vuex'
import { useMessage, useNotification } from 'naive-ui'
import { Save20Regular } from '@vicons/fluent'

export default {
  components: {
    Save20Regular
  },
  props: {
    model: {
      type: Object ,
      required: true ,
      default: () => {
        return reactive({
          name: 'Undefined' ,
          title: 'No title'
        })
      },
      // validator: (val) => {}
    } , 
    record: {
      type: Object ,
      required: false ,
      default: () => {
        return reactive({
          id: 0 ,
          username: '' ,
          firstname: '' ,
          lastname: '' ,
          email: '' ,
          phone: '',
          active: 1 ,
          password: ''
        })
      },
      // validator: (val) => {
      //   for(var field in ['id','username','firstname','lastname','email','phone','password','active'] ){
      //     if( !val.hasOwnProperty(field) ) return false
      //   }
      //   return true 
      // }
    },
    show: {
      type: Boolean ,
      default: false
    },
    onClose: {
      type: Function
    } ,
    // onShow: {
    //   type: Function
    // }
  },
  setup(props){
    const store = useStore()
    const message = useMessage()
    const notify = useNotification()
    /**
     * Variables
     */    
    const rules = {
        firstname: {
          required: true,
          message: 'សូមបញ្ចូលនាមខ្លួន',
          trigger: [ 'blur']
        },
        lastname: {
          required: true,
          message: 'សូមបញ្ចូលត្រកូល',
          trigger: [ 'blur']
        },
        password: {
          required: true,
          message: 'សូមបញ្ចូលពាក្យសម្ងាត់',
          trigger: [ 'blur']
        }
    }
    const helpers = reactive({
      username: false ,
      email: false ,
      phone: false ,
    })
    /**
     * Functions
     */
    function clearRecord(){
      props.record = {
        id : 0 ,
        username: '' ,
        lastname: '' ,
        firstname: '' ,
        phone: '' ,
        email: '' ,
        password: '' ,
        active: 1
      }
    }

    function create(){
      if( props.record.email == "" ){
        notify.warning({
          'title' : 'ពិនិត្យព័ត៌មាន' ,
          'description' : 'សូមបំពេញ អ៊ីមែល។' ,
          duration : 3000
        })
        return false
      }
      // if( props.record.phone == "" ){
      //   notify.warning({
      //     'title' : 'ពិនិត្យព័ត៌មាន' ,
      //     'description' : 'សូមបំពេញ លេខទូរស័ព្ទ។' ,
      //     duration : 3000
      //   })
      //   return false
      // }
      if( props.model === undefined || props.model.name == "" ){
        notify.warning({
          'title' : 'ពិនិត្យព័ត៌មាន' ,
          'description' : 'ទម្រង់នៃព័ត៌មានមិនទាន់បានកំណត់។' ,
          duration : 3000
        })
        return false
      }
      store.dispatch( props.model.name+'/create',{
        // id: props.record.id ,
        username: props.record.username ,
        firstname: props.record.firstname ,
        lastname: props.record.lastname ,
        phone: props.record.phone ,
        email: props.record.email ,
        password: props.record.password ,
        active: props.record.active == 1 ? 1 : 0
      }).then( res => {
        switch( res.status ){
          case 200 : 
          notify.warning({
            'title' : 'រក្សារទុកព័ត៌មាន' ,
            'description' : res.data.message ,
            duration : 3000
          })
          clearRecord()
          props.onClose()
          break;
        }
      }).catch( err => {
        console.log( err )
        notify.error({
          'title' : 'រក្សារទុកព័ត៌មាន' ,
          'description' : 'មានបញ្ហាក្នុងពេលរក្សារទុកព័ត៌មាន។' ,
          duration : 3000
        })
      })
    }
    
    function checkUsername(){
      if( props.record.username != "" ){
        store.dispatch('user/checkUsername',{username: props.record.username}).then( res => {
          if( res.data.ok ){
            notify.info({
              title: 'ពិនិត្យឈ្មោះអ្នកប្រើប្រាស់' ,
              description : "ឈ្មោះអ្នកប្រើប្រាស់ មានរួចហើយ។" ,
              duration : 3000
            })
          }
        }).catch( err => {
          console.log( err )
          notify.error({
            'title' : 'ពិនិត្យឈ្មោះអ្នកប្រើប្រាស់' ,
            'description' : 'មានបញ្ហាក្នុងពេលពិនិត្យឈ្មោះអ្នកប្រើប្រាស់។' ,
            duration : 3000
          })
        })
      }
    }
    function checkPhone(){
      if( props.record.phone != "" ){
        store.dispatch('user/checkPhone',{phone: props.record.phone}).then( res => {
          if( res.data.ok ){
            notify.info({
              title: 'ពិនិត្យលេខទូរស័ព្ទ' ,
              description : "លេខទូរស័ព្ទ មានរួចហើយ។" ,
              duration : 3000
            })
          }
        }).catch( err => {
          console.log( err )
          notify.error({
            'title' : 'ពិនិត្យលេខទូរស័ព្ទ' ,
            'description' : 'មានបញ្ហាក្នុងពេលពិនិត្យលេខទូរស័ព្ទ។' ,
            duration : 3000
          })
        })
      }
    }
    function checkEmail(){
      if( props.record.email != "" ){
        store.dispatch('user/checkEmail',{email: props.record.email}).then( res => {
          if( res.data.ok ){
            notify.info({
              title: 'ពិនិត្យអ៊ីមែល' ,
              description : "ពិនិត្យអ៊ីមែល មានរួចហើយ។" ,
              duration : 3000
            })
          }
        }).catch( err => {
          console.log( err )
          notify.error({
            'title' : 'រក្សារទុកព័ត៌មាន' ,
            'description' : 'មានបញ្ហាក្នុងពេលពិនិត្យអ៊ីមែល។' ,
            duration : 3000
          })
        })
      }
    }

    return {
      /**
       * Variables
       */
      rules ,
      /**
       * Functions
       */
      create ,
      checkUsername ,
      checkPhone ,
      checkEmail
    }
  }
}
</script>