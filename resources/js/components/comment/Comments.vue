<template>
    <div class="comments-main">
        <hr id="comments-line" ref="line" :style="{height:line + 'px'}">
        <comment-card></comment-card>
        <replies-card></replies-card>
        <comment-card></comment-card>
        <comment-card></comment-card>
        <comment-card ref="last"></comment-card>
    </div>
</template>

<script>
    export default {
        name: "Comments",
        data(){
            return{
                line: 0,
            }
        },
        props:{
            show:{
                type: Boolean,
                required: true,
            }
        },
        mounted() {
            this.line = this.$refs.last.$el.offsetTop - this.$refs.line.offsetTop;
        },
    }
</script>

<style scoped>

</style>