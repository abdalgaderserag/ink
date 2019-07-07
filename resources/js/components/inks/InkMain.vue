<template>
    <div class="main">
        <div v-if="inks.length !== 0" v-for="(ink,index) in inks">
            <ink-card :ink="getInk(ink)" :number="index"></ink-card>
        </div>
        <div v-if="inks.length === 0 && ready">
            <h2>You didnt follow any one yet search know!</h2>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inks: [],
                ready: false,
            }
        },
        mounted() {
            window.axios.defaults.headers.common["Authorization"] = "Bearer " + this.$root.access_token;
            let link = document.location.pathname;

            axios.get('/api/notification').then((response) => {
                this.$root.$children[1].notifications = response.data;
            });

            if (link === '/')
                link = '/home';
            if (link.indexOf('/', 1) !== -1) {
                link = link.slice(link.indexOf('/', 1), link.length)
            }
            //TODO : change the link to '/api/inks'
            axios.get('/api/ink' + link)
                .then((response) => {
                    this.inks = response.data;
                    this.ready = !this.ready;
                }).catch((error) => {
                console.log('error:\n'.error)
            })
        },
        methods: {
            getInk: function (ink) {
                let temp = ink.media.media;
                if (ink.media.media !== null) {
                    let num = temp.length - 1;
                    try {

                        temp = temp.split(',');
                        temp[0] = temp[0].slice(1, temp[0].length);
                        temp.pop();
                    } catch (e) {
                    }
                }
                ink.media.media = temp;
                return ink;
            }
        }
    }
</script>

<style>
    .main .ink-card .card-body {
        background-color: #FFFFFF;
    }
</style>