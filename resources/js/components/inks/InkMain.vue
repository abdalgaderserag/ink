<template>
    <div class="main">
        <div v-for="(ink,index) in inks">
            <ink-card :ink="ink" :number="index"></ink-card>
        </div>
        <div v-if="inks === []">
            <h2>You didnt follow any one yet search know!</h2>
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
            window.axios.defaults.headers.common["Authorization"] = "Bearer " + this.$root.access_token;
            var link = document.location.pathname;
            if (link.indexOf('/', 1) !== -1) {
                link = link.slice(link.indexOf('/', 1), link.length)
            }
            axios.get('/api/ink' + link)
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