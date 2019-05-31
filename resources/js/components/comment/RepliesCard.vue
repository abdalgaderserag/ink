<template>
    <div>
        <hr class="comments-line replies-line" ref="line" :style="{height:line + 'px'}">
        <div v-for="reply in replies">
            <reply-card :reply="reply"></reply-card>
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
        mounted() {
            // this.line = this.$refs.last.$el.offsetTop - this.$refs.line.offsetTop;
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