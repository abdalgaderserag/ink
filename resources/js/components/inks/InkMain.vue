<template>
    <div class="main">
        <div v-for="(ink,index) in inks">
            <ink-card :ink="ink" :number="index"></ink-card>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inks: [],
            }
        },
        mounted() {
            var link = document.location.pathname;
            axios({
                url: '/api/ink' + link,
            })
                .then((response) => {
                    this.inks = response.data
                }).catch((error) => {
                console.log('error:\n'.error)
            })
        }
    }
</script>

<style>
    .main .ink-card .card-body {
        background-color: #FFFFFF;
    }
</style>