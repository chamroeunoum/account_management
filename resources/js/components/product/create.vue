<template>
  <div class="crud-create-form w-full">
    <div class=" mx-auto my-8 border border-gray-200 p-8 rounded shadow-sm flex-wrap">
      <div class="crud-form-top-panel flex w-full">
        <div class="flex-none crud-actions">
          <n-button ghost class="" @click="$router.push('/'+model.name)">
            <template #icon>
              <n-icon>
                <ArrowBackIosNewRound />
              </n-icon>
            </template>
          </n-button>
        </div>
        <div class="flex-grow crud-create-title font-pvh text-xl" v-html="model.title" ></div>
        <div class="flex-none crud-actions">
          <n-button type="success" @click="saveProduct()" >
            <template #icon>
              <n-icon>
                <save />
              </n-icon>
            </template>
            រក្សារទុក
          </n-button>
        </div>
      </div>
      <div class="crud-form-panel w-full flex flex-wrap py-8 ">
        <n-form 
          class="w-1/2 text-left font-btb text-lg" 
          :label-width="80"
          :model="record"
          :rules="rules"
          size="large"
          ref="formRef"
        >
          <n-form-item label="ឈ្មោះសាខា" path="from">
            <n-input :disabled="true" v-model:value="record.from" placeholder="ឈ្មោះសាខា" />
          </n-form-item>
          <n-form-item label="អតិថិជន" >
            <n-auto-complete :options="clientfilters" v-model:value="client.record" placeholder="សូមជ្រើសរើសអតិថិជន" />
          </n-form-item>
          <n-form-item label="គោលដៅរបស់ឥវ៉ាន់" path="to">
            <n-input v-model:value="record.to" placeholder="គោលដៅរបស់ឥវ៉ាន់" />
          </n-form-item>
          <n-form-item label="លេខអ្នកផ្ញើ" path="sender_phone">
            <n-input v-model:value="record.sender_phone" placeholder="លេខអ្នកផ្ញើ" />
          </n-form-item>
          <n-form-item label="លេខអ្នកទទួល" path="receiver_phone">
            <n-input v-model:value="record.receiver_phone" placeholder="លេខអ្នកទទួល" />
          </n-form-item>
          <n-form-item label="តម្លៃផ្ញើ (បាត)" path="price">
            <n-input v-model:value="record.price" placeholder="តម្លៃផ្ញើ" />
          </n-form-item>
          <n-form-item label="ទំងន់ (គីឡូ)" >
            <n-input v-model:value="record.weight" placeholder="ទំងន់" />
          </n-form-item>
          <n-form-item label="សម្គាល់" >
            <n-input 
              type="textarea"
              :autosize="{
                minRows: 3,
                maxRows: 5
              }"
              v-model:value="record.note" 
              placeholder="សម្គាល់" />
          </n-form-item>
        </n-form>
        <div class="w-1/2 h-8"></div>  
      </div>
    </div>
  </div>
</template>
<script>
import { ref } from 'vue'
import { useMessage } from 'naive-ui'
import { Icon } from '@vicons/utils'
import { Save } from "@vicons/carbon"
import { ArrowBackIosNewRound } from '@vicons/material'
export default {
  setup(){
    const formRef = ref(null)
    const message = useMessage()
    return {
      formRef,
      model: ref({
        name: 'package' ,
        title: 'បន្ថែមព័ត៌មានថ្មី'
      }),
      client: ref({
        records: [
          {
            label: "ចាន់ ភោគ" ,
            value: 1
          },
          {
            label: "ចាន់ ជាយា" ,
            value: 4
          },
          {
            label: "ឈាវ ដាវ" ,
            value: 2
          },
          {
            label: "ភី មាឃ" ,
            value: 3
          }
        ] ,
        record: '' ,
        filters: []
      }),
      record: ref({
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
      }),
      rules: {
        to: {
          required: true,
          message: 'សូមបញ្ចូលកន្លែងបញ្ជូនឥវ៉ាន់ទៅ',
          trigger: 'blur'
        },
        sender_phone: {
          required: true,
          message: 'សូមបញ្ចូលលេខទូរស័ព្ទអ្នកផ្ញើ',
          trigger: [ 'blur']
        },
        receiver_phone: {
          required: true,
          message: 'សូមបញ្ចូលលេខទូរស័ព្ទអ្នកទទួល',
          trigger: [ 'blur']
        },
        price: {
          required: true,
          message: 'សូមបញ្ចូលតម្លៃផ្ញើ',
          trigger: [ 'blur']
        }
      },
      handleValidateClick (e) {
        e.preventDefault()
        formRef.value.validate((errors) => {
          if (!errors) {
            message.success('Valid')
          } else {
            console.log(errors)
            message.error('Invalid')
          }
        })
      }
    }
  },
  components: {
    ArrowBackIosNewRound,
    Icon,
    Save
  },
  data(){
    return {
      // model: {
      //   name: 'product' ,
      //   title: 'បន្ថែមព័ត៌មានថ្មី'
      // },
      // client: {
      //   records: [
      //     {
      //       label: "ចាន់ ភោគ" ,
      //       value: 1
      //     },
      //     {
      //       label: "ចាន់ ជាយា" ,
      //       value: 4
      //     },
      //     {
      //       label: "ឈាវ ដាវ" ,
      //       value: 2
      //     },
      //     {
      //       label: "ភី មាឃ" ,
      //       value: 3
      //     }
      //   ] ,
      //   record: '' ,
      //   filters: []
      // },
      // record: {
      //   id: 0 ,
      //   client_id: 0 ,
      //   code: '' ,
      //   from: 'បាងកក' ,
      //   to: '' ,
      //   sender_phone: '' ,
      //   receiver_phone: '' ,
      //   weight: '' ,
      //   dimension: '60x40x20' ,
      //   price: '' ,
      //   note: ''
      // }
    }
  },
  computed:{
    clientfilters(){
      let filter = this.client.records.filter( c => c.label.indexOf( this.client.record ) != -1 )
      return filter.length <= 0 ? this.client.records : filter
    }
  },
  methods: {
    saveProduct(){
      if( !this.validateData(this.product) ){
        return false
      }
      this.savingLoading = true 
      this.$store.dispatch('product/create', this.product ).then( res => {
        switch( res.status ){
          case 200 : 
            this.getRecords()
            break;
          default:

            break;
        }
        this.product = this.clearProduct
        this.toggleCreatePopup(false)
        this.savingLoading = false 
      }).catch( err => {
        console.log( err )
      })
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
  }
}
</script>
<style scoped>
  label.n-form-item-label {
    @apply text-lg ;
  }
</style>