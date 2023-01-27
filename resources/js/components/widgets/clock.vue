<template>
    <!-- Start Widget -->
    <div class="w-56 h-56 m-4 text-center">
        <div class="w-40 h-40 text-center uppercase border rounded">
            Clock element
        </div>
        <div class="w-40 h-16 py-2 mt-2 text-center" >Clock</div>
    </div>
    <!-- End widget -->
</template>
<script>

export default {
    components: {
        
    },
    props: [
        'size'
    ],
    data() {
        return {
            icon: {
                size: this.size
            }
        }
    },
    computed: {

    },
    mounted() {
        
    },
    methods: {
        /** Get total documents of the user */
    },
}
</script>