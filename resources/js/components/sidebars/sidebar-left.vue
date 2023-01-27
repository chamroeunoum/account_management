<template>
  <div class="fixed bottom-0 left-0 border-r top-16 w-60 bg-gray-100 font-btb text-lg" >
    <!-- Menu -->
    <div v-if="sidebarToggle" class="absolute w-full sidebar">
      <!-- Menu Item -->
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <!-- Label -->
        <router-link to="/user" class="flex-grow leading-10 text-left label " >
          <div class="text-md">អ្នកប្រើប្រាស់</div>
        </router-link>
      </div>
      <!-- Menu Item -->
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
          </svg>
        </div>
        <!-- Label -->
        <router-link to="/client" class="flex-grow leading-10 text-left label " >
          <div class="text-md">អតិថិជន</div>
        </router-link>
      </div>
      <!-- Menu Item -->
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        </div>
        <!-- Label -->
        <router-link to="/receive" class="flex-grow leading-10 text-left label " >
          <div class="text-md">ឥវ៉ាន់</div>
        </router-link>  
      </div>
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
          </svg>
        </div>
        <!-- Label -->
        <router-link to="/staff" class="flex-grow leading-10 text-left label " >
          <div class="text-md">បុគ្គលិក</div>
        </router-link>
      </div>
      <!-- Menu Item -->
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
          </svg>
        </div>
        <!-- Label -->
        <router-link to="/user" class="flex-grow leading-10 text-left label " >
          <div class="text-md">ឡាន</div>
        </router-link>  
      </div>
      <!-- Menu Item -->
      <div class="flex w-full h-12 p-1 bg-gray-100 border-b">
        <!-- iCon -->
        <div class="flex-grow-0 w-10 h-10 p-2 text-blue-500 icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
        </div>
        <!-- Label -->
        <a @click="logout" class="flex-grow leading-10 text-left label " >ចាកចេញ</a>  
      </div>
    </div> 
    <!-- <div class="sidebar-toggle">
      <div v-if="sidebarToggle" @click="toggleSidebarFunc(false)" class="absolute w-12 h-12 leading-10 bg-gray-200 rounded-r -right-12" >Hide</div>
      <div v-if="!sidebarToggle" @click="toggleSidebarFunc(true)" class="absolute w-12 h-12 leading-10 bg-gray-200 rounded-r -right-12" >Show</div>
    </div> -->
    <div class="absolute bottom-0 w-full  justify-center" >
      <Footer />
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import Footer from './../../components/footer/copy-right.vue'
import { Notify } from 'vant'
import { isAuth, authLogout } from './../../plugins/authentication'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import { useDialog , useMessage } from 'naive-ui'

export default {
  setup(){
    const dialog = useDialog();
    const message = useMessage();
    const store = useStore();
    const router = useRouter()
    async function logout(){
      const d = dialog.warning({
        title: 'ចាកចេញ',
        content: 'តើអ្នកចង់ចាកចេញមែនទេ?',
        positiveText: 'បាទ / ចាស',
        negativeText: 'ទេ',
        onPositiveClick: () => {
          /**
           * Check whether the user has logged out already
           */
          if( isAuth() ) {
            /**
             * Show confirm dialog
             */
            d.loading = true
            store.dispatch('auth/logout').then( res => {
              authLogout()
              message.success(res.data.message)
              d.loading = false
              router.push('/login')
            }).catch( err => {
              console.log( err )
            })
          }else{
            router.push('/login')
          }
        },
        // onNegativeClick: () => {
        //   message.error('Not Sure')
        // }
      })
    }

    return {
      logout
    }
  },
  components: {
    Footer
  },
  name: 'sidebar-left' ,
  data() {
    return {
      logoutConfirmationDialog: false ,
      sidebarToggle : true ,
      menus: [
        {
          label: 'ឥវ៉ាន់' ,
          to: '/package'
        },
        {
         
          label: 'អ្នកប្រើប្រាស់' ,
          to: '/user'
        },
        {
         
          label: 'អតិថិជន' ,
          to: '/customer'
        },
        {
         
          label: 'Chat' ,
          to: '/label'
        },
        {
          icon: 'chat-o' ,
          label: 'Setting' ,
          to: '/label'
        }
      ]
    }
  },
  methods: {
    toggleSidebarFunc(helper){
      this.sidebarToggle = helper
    }
  }
}
</script>