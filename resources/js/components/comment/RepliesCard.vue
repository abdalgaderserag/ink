<template>
    <div>
        <hr class="comments-line replies-line" ref="line" :style="{height:line + 'px'}">
        <div v-for="(reply, index) in replies">
            <reply-card :reply="reply" :id="index"></reply-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RepliesCard",
        data() {
            return {
                line: 0,
            }
        },
        props: {
            replies: {
                type: Array,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>