<template>
    <div class="main">
        <div v-for="ink in inks">
            <ink-card :ink="ink"></ink-card>
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
                header: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer 79ff0a4eeafbeb8ec37192dec2883ae6bae922a8815a13e6daaacd624eab4a1e0c17b7bb4ba4dc50',
                }
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