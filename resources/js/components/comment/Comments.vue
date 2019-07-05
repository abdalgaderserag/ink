<template>
    <div class="comments-main" v-show="show">
        <input type="text" class="input-text" v-model="text">
        <button class="input-bottom" @click="reply()">Reply</button>
        <br>
        <hr id="comments-line" ref="line" :style="{borderBottomWidth:line + 'px'}">
        <div v-for="(comment, index) in comments">
            <div v-if="index + 1 === comments.length">
                <comment-card :comment="comment" ref="end" :number="index"></comment-card>
            </div>
            <div v-else>
                <comment-card :comment="comment" :number="index"></comment-card>
            </div>
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
                    if (this.comments[this.comments.length - 1] === null)
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
        },
        updated(){
            // TODO use in delete
            // this.line =
            //     this.$el.children[this.$el.children.length - 1].offsetTop
            //     - this.$el.children[3].offsetTop;
        },
        methods: {
            reply: function () {
                if (this.text !== '')
                    axios.post('api/create-comment', {
                        'text': this.text,
                        'ink_id': this.id,
                        'user_id': this.$parent.ink.user.id,
                    }).then((response) => {
                        this.comments.push(response.data);
                        this.$parent.commentCount++;
                        this.text = '';
                    });

            }
        }
    }
</script>

<style scoped>

</style>