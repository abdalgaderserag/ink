<template>
    <div class="comments-main" v-show="show">
        <!--<input v-model="text" type="text" style="border: 1px solid #9a9a9a;width: 80%;height:34px;margin-bottom: 24px;padding: 8px">-->
        <!--<button style="height: 52px;padding: 8px;width: 10%;background-color: rgba(154,154,154,0.51);border: #636b6f solid 1px">-->
            <!--file-->
        <!--</button>-->
        <!--<span>Ink</span>-->
        <input type="text" class="input-text">
        <button class="input-bottom">Reply</button>
        <br>
        <hr id="comments-line" ref="line" :style="{height:line + 'px'}">
        <div v-for="(comment, index) in comments">
            <comment-card v-show="index + 1 !== comments.length" :comment="comment"></comment-card>
            <comment-card v-show="index + 1 === comments.length" :id="'comment' + comment.id"
                          :comment="comment"></comment-card>
            <replies-card v-show="comment.replies" :replies="comment.replies"></replies-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comments",
        data() {
            return {
                line: 0,
                comments: [],
                text: '',
            }
        },
        mounted() {
            axios.get('/api/show-ink/' + this.id)
                .then((response) => {
                    this.comments = response.data;
                    this.$parent.commentCount = this.comments.length
                    this.$parent.commentId = this.comments[this.comments.length - 1].id
                });
        },
        props: {
            show: {
                type: Boolean,
                required: true,
            },
            id: {
                type: Number,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>