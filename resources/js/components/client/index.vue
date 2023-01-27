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
  name: "Client" ,
  components: {
    ListForm
  },
  setup() {
    const model = reactive({
        name: 'client' ,
        title: 'អតិថិជន'
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
        field: 'address' ,
        label: 'អសយដ្ឋាន'
      }
    ])

    const searchable = ref(['firstname','lastname','phone','email','address'])

    return {
      model ,
      columns ,
      searchable
    }
  },
}
</script>