<template>
    <div class="comments-main" v-show="show">
        <hr id="comments-line" ref="line" :style="{height:line + 'px'}">
        <div v-for="(comment, index) in comments">
            <!--<comment-card ref="comment" :comment="comment"></comment-card>-->
            <comment-card v-show="index + 1 !== comments.length" :comment="comment"></comment-card>
            <comment-card v-show="index + 1 === comments.length" :id="'comment' + comment.id" :comment="comment"></comment-card>
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
            }
        },
        mounted() {
            axios.get('/api/show-ink/' + this.id)
                .then((response) => {
                    this.comments = response.data;
                    this.$parent.commentCount = this.comments.length
                    this.$parent.commentId = this.comments[this.comments.length - 1].id
                });
            // console.log(lineHe())
            // console.log(this.$refs.line)
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
        },
        methods: {
            lineHeigth: function () {

                // this.line = document.getElementById('comment'+this.last).offsetTop - this.$refs.line.offsetTop;
            },
            // styleChenged: function () {
            //     axios.get()
            //     this.lineHeigth()
            // }
        }
    }
</script>

<style scoped>

</style>