<template>
</template>

<script>
    export default {
        name: "FileReader",
        data(){
            return{
                images:[],
            }
        },
        props:{
            file:{
                type: String,
                required: true,
            },
            post:{
                type: String,
                required: true,
            }
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>