<template>
  <div class="relative w-full min-h-screen bg-gray-50 bg-center bg-cover bg-background" oncontextmenu="return false; " >
    <!-- Top menu -->
    <div class="absolute p-4 top-16 right-0 bottom-0 left-0 ">
      <router-view ></router-view>  
    </div>
    <!-- <SidebarLeft /> -->
    <Dock />
    <Topmenu />
    <!-- <Dock /> -->
  </div>
</template>

<script>
import { ref } from 'vue'
import Topmenu from './../../components/menu/topmenu.vue'
import Dock from './dock.vue'
import SidebarLeft from './../../components/sidebars/sidebar-left.vue'
export default {
    setup() {
        return {};
    },
    name: "DashboardPage", 
    data() {
        return {};
    },
    computed: {},
    mounted() {
    },
    methods: {},
    components: { 
      Topmenu ,
      SidebarLeft ,
      Dock
    }
}
</script>