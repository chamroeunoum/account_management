<template>
  <div class="flex flex-wrap content-center" >
        <!-- Start transaction of the apps -->
        <transition  name="fade" mode="out-in">
            <!-- Apps -->
            <div v-if="toggleApps" class="fixed top-0 bottom-0 left-0 right-0 z-40 flex flex-wrap content-start w-full px-4 py-24 bg-gray-800 sm:px-4 md:px-4 lg:p-24 xl:p-24 bg-opacity-95">
                <!-- Search -->
                <div class='absolute top-0 left-0 right-0 flex flex-wrap content-center w-2/5 py-4 m-auto md:w-2/5 xl:w-1/5 lg:w-1/5' >
                    <Input suffix="ios-search" placeholder="ស្វែងរក ..." clearable @on-clear="matchedApps=apps" v-model="search.value" @on-keyup="search.value.trim()!==''?matchedApps=apps.filter( app => app.name.toLowerCase().indexOf( search.value.toLowerCase() ) != -1 ):matchedApps=apps"  />
                </div>
                <!-- End search -->
                <!-- Apps -->
                <div class="flex flex-wrap content-center apps">
                    <div v-for="(app, index) in matchedApps" :key="index" class="w-32 h-32 text-center p4 md-auto">
                        <div @click="toggleApps=false;$router.push(app.url)" class='w-full dashboard-widget-link' >
                            <Icon :type="app.icon" class='text-gray-100 ' size="64" />
                            <div class="p-2 m-auto text-sm text-center text-gray-100" v-html="app.name" ></div>
                        </div>
                    </div>
                </div>
                <!-- End apps -->
            </div>
        </transition>
        <!-- End transaction of the apps -->
        <!-- Apps launcher -->
        <div class='fixed bottom-0 left-0 right-0 z-50 flex flex-wrap justify-center w-full py-4' >
            <!-- Apps icon -->
            <div @click="toggleApps = !toggleApps" class="w-12 h-12 p-2 mx-2 text-center bg-white border border-black rounded-full shadow cursor-pointer " >
                <span class="fa-li"><i class="fas fa-check-square"></i></span>
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
export default {
    name: 'dock' ,
    props: [
        'active'
    ],
    data() {
        return {
            /** Start app metadata */
            search: {
                value: ''
            },
            matchedApps: [] ,
            apps: [
                // {
                //     url: '/attendent' ,
                //     icon: 'md-finger-print' ,
                //     name: 'វត្តមាន',
                //     roles: [
                //         1, // Admin
                //         // 2, // Super
                //         // 3, // Auditor
                //         // 4, // Member
                //         // 5 // Customer
                //     ]
                // },
                // {
                //     url: '/dflow' ,
                //     icon: 'ios-cog-outline' ,
                //     name: 'លំហូរឯកសារ' ,
                //     roles: [
                //         1, // Admin
                //         // 2, // Super
                //         // 3, // Auditor
                //         // 4, // Member
                //         // 5 // Customer
                //     ]
                // },
                {
                    url: '/archive' ,
                    icon: 'md-document' ,
                    name: 'សាស្ត្រាច្បាប់',
                    roles: [
                        1, // Admin
                        2, // Super
                        3, // Auditor
                        // 4, // Member
                        // 5 // Customer
                    ]
                },
                {
                    url: '/task' ,
                    icon: 'md-list' ,
                    name: 'កិច្ចការ',
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
                    icon: 'ios-contacts-outline' ,
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
                    url: '/profile' ,
                    icon: 'ios-contact-outline' ,
                    name: 'អ្នកប្រើប្រាស់',
                    roles: [
                        1, // Admin
                        2, // Super
                        3, // Auditor
                        4, // Member
                        5 // Customer
                    ]
                },
                {
                    url: '/news' ,
                    icon: 'ios-notifications-outline' ,
                    name: 'ជូនដំណឹង',
                    roles: [
                        1, // Admin
                        2, // Super
                        3, // Auditor
                        4, // Member
                        5 // Customer
                    ]
                },
                {
                    url: '/subscriptions' ,
                    icon: 'ios-cash-outline' ,
                    name: 'ការជាវ',
                    roles: [
                        1, // Admin
                        2, // Super
                        3, // Auditor
                        4, // Member
                        5 // Customer
                    ]
                }
            ] ,
            /** End app metadata */
            toggleApps: false,
            user: null
        }
    },
    computed: {
    },
    mounted() {
        this.matchedApps = this.apps
        this.search.value= ""
        // this.user = localStorage.getItem( 'user' ) ? JSON.parse( localStorage.getItem( 'user' ) ) : null
        // if( this.user !== null && this.user.roles !== null && this.user.roles.length > 0 ){
        //     this.matchedApps = []
        //     for(var i in this.apps ){
        //         for(var j in this.apps[i].roles ){
        //             let app = this.user.roles.find( role => role == this.apps[i].roles[j] )
        //             app !== undefined ? this.matchedApps.push( this.apps[i] ) : false
        //         }
        //     }
        // }else{
        //     console.log( "ព័ត៌មានសម្រាប់ការចូលប្រើប្រាស់ មិនគ្រប់គ្រាន់។ សូមចូលប្រើម្ដងទៀត ។ សូមអរគុណ !" )
        // }
        console.log( this.matchedApps)
    },
    methods: {
        toggleAppFunc(){
            this.toggleApps = !this.toggleApps
        },
        logoutConfirmation(){
            console.log( "confirm before logout" )
        },
    },
}
</script>