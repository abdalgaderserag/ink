<template>
    <div class="notification">
        <div>
            <a v-for="notification in notifications">
                {{ displayNotification(notification) }}
                <hr>
            </a>
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

            },
            displayNotification: function (notification) {
                let text = '';
                if (notification.type === "App\\Notifications\\CommentLiked") {
                    // text = "new comment by  <a href='/profile/" + notification.data.slug + "'>" + notification.data.name + "</a> in your ink"
                    text = "new comment by " + notification.data.name + "in your ink."
                } else if (notification.type === "App\\Notifications\\InkLiked") {
                    // text = "your ink has been liked by <a href='/profile/'>" + notification.data.slug + "'>" + notification.data.name + "</a>"
                    text = "your ink has been liked by " + notification.data.name + "."
                }
                return text;
            }
        },
    }
</script>

<style scoped>
    .notification {
        width: 18%;
        border-radius: 2px;
        /*height: 60px;*/
        padding: 8px;
        display: none;
        background-color: #ffffff;
        position: absolute;
        left: 1080px;
        top: 72px;
    }
</style>