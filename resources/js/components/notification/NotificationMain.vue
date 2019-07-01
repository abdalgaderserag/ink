<template>
    <div class="notification">
        <div v-for="notification in notifications">
            <a>{{ notification }}</a>
            <hr>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotificationMain",
        data() {
            return {
                notifications: [],
            }
        },
        methods: {
            showNotification: function () {

            }
        }, mounted() {
            // axios.get('/api/notification').then((response) => {
            //     console.log(response.data)
            // })
        }
    }
</script>

<style scoped>
    .notification {
        width: 18%;
        border-radius: 2px;
        height: 60px;
        display: none;
        background-color: #ffffff;
        position: absolute;
        left: 1080px;
        top: 72px;
    }
</style>