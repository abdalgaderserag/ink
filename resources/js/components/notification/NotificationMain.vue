<template>
    <div class="notification">

    </div>
</template>

<script>
    export default {
        name: "NotificationMain",
        methods:{
            showNotification:function () {

            }
        },mounted() {
            axios.get()
        }
    }
</script>

<style scoped>
.notification{
    width: 18%;
    height: 60px;
    display: none;
    background-color: #ffffff;
    position: absolute;
    left: 1080px;
    top: 72px;
}
</style>