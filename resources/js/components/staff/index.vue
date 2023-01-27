<template>
  <div class="w-full " >
    <list-form 
      :show="true" 
      :model="model" 
      :columns="columns"
      :searchable="searchable"
      :perPage="20" />
  </div>
</template>
<script>
import { ref , reactive } from 'vue'
import ListForm from './list.vue'
export default {
  name: "Staff" ,
  components: {
    ListForm
  },
  setup() {
    const model = reactive({
        name: 'staff' ,
        title: 'បុគ្គលិក'
      })
    const columns = ref([
      { 
        field: 'id' ,
        label: 'លេខសម្គាល់'
      },
      { 
        field: 'lastname' ,
        label: 'ត្រកូល'
      },
      { 
        field: 'firstname' ,
        label: 'ឈ្មោះ'
      },
      { 
        field: 'phone' ,
        label: 'ទូរស័ព្ទ'
      },
      { 
        field: 'email' ,
        label: 'អ៊ីមែល'
      },
      { 
        field: 'salary' ,
        label: 'ប្រាក់ខែ'
      },
      { 
        field: 'address' ,
        label: 'អសយដ្ឋាន'
      }
    ])

    const searchable = ref(['firstname','lastname','phone','email','salary','address'])

    return {
      model ,
      columns ,
      searchable
    }
  },
}
</script>