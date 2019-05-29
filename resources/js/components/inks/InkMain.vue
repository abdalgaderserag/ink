<template>
    <div class="main">
        <div v-for="ink in inks">
            <ink-card :ink="ink"></ink-card>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                inks:[],
            }
        },
        mounted() {
            var link = document.location.pathname;
            axios.get('/api/ink' + link)
                .then((response) => {
                    this.inks = response.data
                }).catch((error) => {
                    console.log('error:\n' . error)
            })
        }
    }
</script>

<style>
    .main .ink-card .card-body{
        background-color: #FFFFFF;
    }
</style>