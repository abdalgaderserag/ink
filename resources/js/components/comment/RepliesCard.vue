<template>
    <div>
        <hr class="comments-line replies-line" ref="line" :style="{height:line + 'px'}">
        <reply-card></reply-card>
        <reply-card></reply-card>
        <reply-card></reply-card>
        <reply-card ref="last"></reply-card>
    </div>
</template>

<script>
    export default {
        name: "RepliesCard",
        data(){
            return{
                line: 0,
            }
        },
        mounted() {
            this.line = this.$refs.last.$el.offsetTop - this.$refs.line.offsetTop;
        },
        props:{
            replies:{
                type: Object,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>