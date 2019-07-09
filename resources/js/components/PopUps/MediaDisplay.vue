<template>
    <!--<div style="height: 604px" class="pop-card">-->
    <div style="height: 604px;margin-left: 42%;margin-top: 60px">
        <img :src="media" style="height: inherit" alt="">
    </div>
</template>

<script>
    export default {
        name: "MediaDisplay",
        props: {
            media: {
                type: String,
                required: true,
            }
        },
    }
</script>

<style scoped>

</style>