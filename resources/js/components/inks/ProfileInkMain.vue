<template>
    <div class="main">
        <div v-for="ink in inks">
            <profile-ink-card v-bind:ink="ink"></profile-ink-card>
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
            console.log('mounted')
            axios.get('api/all')
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