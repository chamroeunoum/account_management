<template>
  <div class="flex flex-wrap content-center" >
        <!-- Start transaction of the apps -->
        <transition  name="fade" mode="out-in">
            <!-- Apps -->
            <div v-if="toggleApps" class="fixed top-0 bottom-0 left-0 right-0 z-40 flex flex-wrap content-start w-full px-4 py-24 bg-gray-800 sm:px-4 md:px-4 lg:p-24 xl:p-24 bg-opacity-95">
                <!-- Search -->
                <!-- <div class='absolute top-0 left-0 right-0 flex flex-wrap content-center w-2/5 py-4 m-auto md:w-2/5 xl:w-1/5 lg:w-1/5' >
                    <n-input 
                      suffix="ios-search" 
                      placeholder="ស្វែងរក ..." 
                      clearable 
                      v-model:value="search" 
                      @keyup="filterApps()"  
                    >
                      <template #prefix>
                        <n-icon>
                          <IosSearch />
                        </n-icon>
                      </template>
                    </n-input>

                </div> -->
                <!-- End search -->
                <!-- Apps -->
                <div class="flex flex-wrap content-center apps">
                    <div v-for="(app, index) in matchedApps.value" :key="index" class="w-32 h-32 text-center p4 md-auto">
                        <div @click="toggleApps=false;$router.push(app.url)" class='w-full dashboard-widget-link cursor-pointer ' >
                            <n-icon size="64" class='text-gray-100 ' >
                              <component :is="app.icon" />
                            </n-icon>
                            <div class="font-pvh p-2 m-auto text-sm text-center text-gray-100" v-html="app.name" ></div>
                        </div>
                    </div>
                </div>
                <!-- End apps -->
            </div>
        </transition>
        <!-- End transaction of the apps -->
        <!-- Apps launcher -->
        <div class='fixed -bottom-14 h-12 left-0 right-0 z-50 flex flex-wrap justify-center w-full py-4' >
            <!-- Apps icon -->
            <div @click="toggleApps = !toggleApps" class="w-12 h-12 p-2 -mt-20 mx-2 text-center bg-white rounded-full shadow-md border border-gray-300 cursor-pointer " >
                <n-icon class='text-blue-700 ' size="30" >
                  <Apps />
                </n-icon>
            </div>
            <div @click="logout()" class="w-12 h-12 p-2 -mt-20 mx-2 text-center bg-white rounded-full shadow-md border border-gray-300 cursor-pointer " >
                <n-icon class='text-red-700 ' size="30" >
                  <Power20Regular />
                </n-icon>
            </div>
        </div>
        <!-- Profile launcher -->
        <div class='fixed top-0 right-0 flex flex-wrap content-center p-2' >

        </div>
        <!-- Logout -->
        <div v-if="toggleApps" class='fixed top-0 right-0 flex flex-wrap content-center p-2' >

        </div>
    </div>
</template>

<script>
import { reactive, ref , computed } from 'vue'
import { IosSearch } from '@vicons/ionicons4'
import { SupervisedUserCircleOutlined , SupervisedUserCircleSharp } from "@vicons/material"
import { Apps, SpeedometerOutline } from '@vicons/ionicons5'
import { isAuth, authLogout , isAdmin , getUser } from './../../plugins/authentication'
import { Receipt2 } from '@vicons/tabler'
import { Receipt20Regular , Power20Regular, DocumentPdf24Regular} from '@vicons/fluent'
import { UserMultiple } from '@vicons/carbon'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import { useDialog , useMessage } from 'naive-ui'
export default {  
  components: {
    IosSearch,
    SupervisedUserCircleOutlined ,
    SupervisedUserCircleSharp ,
    Apps ,
    UserMultiple ,
    Receipt20Regular ,
    Receipt2 ,
    SpeedometerOutline ,
    Power20Regular ,
    DocumentPdf24Regular
  } ,
  name: 'dock' ,
  props: [
      'active'
  ],
  setup(){
    let search = ref(null)
    let matchedApps = computed( () => {
        let matched = ref([])
        // if( search.value != '' && search.value != null && search.value.trim() != '' ){
        //   matched.value = apps.value.filter( app => app.name.indexOf( search.value ) != -1 && app.roles.includes( parseInt(getUser().role )) )
        // }else{
        //   matched.value = apps.value.filter( app => app.roles.includes( parseInt(getUser().role) ) )
        // }
        matched .value= apps.value
        // console.log( "Role : " + getUser().role )
        // console.log( matched.value.length )
        return matched
        // search.value != '' || search.value != null ? apps :
        // ( search.value.trim() != '' ?
        //   apps.value.filter( app => app.name.indexOf( search.value ) != -1 ) :
        //   apps
        // )
      }
    )
    let apps = ref([
      {
          url: '/dashboard' ,
          icon: 'SpeedometerOutline' ,
          name: 'ផ្ទាំងព័ត៌មាន',
          roles: [
              1, // Admin
              // 2, // Super
              // 3, // Auditor
              // 4, // Member
              // 5 // Customer
          ]
      },
      {
          url: '/user' ,
          icon: 'SupervisedUserCircleOutlined' ,
          name: 'គណនី',
          roles: [
              1, // Admin
              // 2, // Super
              // 3, // Auditor
              // 4, // Member
              // 5 // Customer
          ]
      },
      {
          url: '/regulator' ,
          icon: 'DocumentPdf24Regular' ,
          name: 'លិខិតបទដ្ឋានគតិយុត្ត',
          roles: [
              1, // Admin
              // 2, // Super
              // 3, // Auditor
              // 4, // Member
              // 5 // Customer
          ]
      },
      // {
      //     url: '/client' ,
      //     icon: 'UserMultiple' ,
      //     name: 'អតិថិជន' ,
      //     roles: [
      //         1, // Admin
      //         2, // Super
      //         // 3, // Auditor
      //         // 4, // Member
      //         // 5 // Customer
      //     ]
      // },
      // {
      //     url: '/receive' ,
      //     icon: 'Receipt20Regular' ,
      //     name: 'បញ្ញើ',
      //     roles: [
      //         // 1, // Admin
      //         2, // Super
      //         // 3, // Auditor
      //         // 4, // Member
      //         // 5 // Customer
      //     ]
      // },
      // {
      //     url: '/staff' ,
      //     icon: 'SupervisedUserCircleSharp' ,
      //     name: 'បុគ្គលិក' ,
      //     roles: [
      //         1, // Admin
      //         // 2, // Super
      //         // 3, // Auditor
      //         // 4, // Member
      //         // 5 // Customer
      //     ]
      // },
      // {
      //     url: '/incomeoutcome' ,
      //     icon: 'Receipt2' ,
      //     name: 'ចំណូលចំណាយ'
      // }
    ])
    /** End app metadata */
    let toggleApps = ref(false)
    let user = reactive({})

    function filterApps(){
      if( search.value != '' && search.value != null && search.value.trim() != '' ){
        matchedApps = apps.value.filter( app => app.name.indexOf( search.value ) != -1 && app.roles.includes( parseInt(getUser().role) ) )
      }else{
        matchedApps = apps.value.filter( app => app.roles.includes( parseInt(getUser().role) ) )
      }
    }
    function toggleAppFunc(){
        toggleApps = !toggleApps
    }
    function logoutConfirmation(){
        console.log( "confirm before logout" )
    }

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
              message.success("អ្នកបានចាកចេញដោយជោគជ័យ។")
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
    function isAdminAccount(){
      return isAdmin()
    }

    return {
      logout ,
      search ,
      matchedApps ,
      apps ,
      toggleApps ,
      user ,
      filterApps ,
      toggleAppFunc ,
      logoutConfirmation ,
      isAdminAccount
    }
  },
  mounted() {
      // this.user = localStorage.getItem( 'user' ) ? JSON.parse( localStorage.getItem( 'user' ) ) : null
      // this.search= ""
      // if( this.user !== null && this.user.roles !== null && this.user.roles.length > 0 ){
      //     this.matchedApps = []
      //     for(var i in this.apps ){
      //         for(var j in this.apps[i].roles ){
      //             let app = this.user.roles.find( role => role == this.apps[i].roles[j] )
      //             app !== undefined ? this.matchedApps.push( this.apps[i] ) : false
      //         }
      //     }
      //     return true
      // }else{
      //     console.log( "ព័ត៌មានសម្រាប់ការចូលប្រើប្រាស់ មិនគ្រប់គ្រាន់។ សូមចូលប្រើម្ដងទៀត ។ សូមអរគុណ !" )
      // }
  }
}
</script>