<template>
  <div class="font-pvh fixed bg-gray-100 top-0 left-0 right-0 flex h-16 p-2 mb-4 border-b border-gray-300" >
    <div class="flex-none w-12 h-12">
        <img src="./../../assets/logo.png" class="w-full rounded-full" alt="SCT Logo" title="SCT Logo" />
    </div>
    <div class="flex-grow h-12 text-xl leading-10 " v-html="title"></div>
    <div class="flex-none w-32 h-10 py-1 mr-2 leading-10 text-right">
      <div class="w-32 "></div>
    </div>
    <div class="flex-none w-12 h-12 cursor-pointer ">
      <div class="w-12 h-12 rounded-full" >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>
  </div>
</template>

<script >
import { computed } from 'vue'
export default {
  props: {
    title: String
  },
  name: 'HorizontalHeader'  ,
  setup(props){
    const title = computed(() => {
      // let user = getUser()
      // return user !== null && user.staff !== null && user.staff.branch !== null ? ' - ' + user.staff.branch.name : "" 
      return props.title
    })
    
    return {
      title
    }
  }
}
</script>