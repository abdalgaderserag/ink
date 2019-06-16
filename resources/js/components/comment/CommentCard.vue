<template>
    <div>
        <div class="comment flew-box">
            <img class="comment-avatar" src="/images/profile.jpeg" alt="">
            <div class="comment-card">
                <div class="comment-text">
                    <span>{{ comment.user.name }}</span>
                    <p>{{ comment.media[0].text }}</p>
                    <div class="comment-footer">
                        <img :src="'/images/' + image" @click="like" width="24px" alt="">
                        <span>{{ comment.like.length }}</span>
                        <img src="/images/comment.svg" width="24px" alt="">
                        <span>{{ comment.replies.length}}</span>
                        <a @click="replyFun()">Reply</a>
                        <a href="/share">Share</a>
                        <a v-show="comment.user.slug == $root.slug" @click="deleteComment()">delete</a>
                        <a v-show="comment.user.slug == $root.slug" @click="showEdit()">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-left: 120px" v-show="showReply">
            <input v-model="text" type="text" class="input-text">
            <button class="input-bottom" @click="createReply()">Reply</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentCard",
        data() {
            return {
                image: 'hard-fill.svg',
                showReply: false,
                text: '',
                editText: '',
            }
        },
        props: {
            comment: {
                type: Object,
                required: true,
            }
        },
        methods: {
            like: function () {
                var temp = this.image;
                if (this.image === "hard-fill-color.svg") {
                    this.image = "hard-fill.svg";
                } else {
                    this.image = "hard-fill-color.svg";
                }
                axios.post('/api/like', {
                    'comment_id': this.comment.id,
                    'type': 'comment',
                }).then((response) => {
                    if (response.data.type) {
                        this.comment.like.push(response.data.like);
                        this.image = "hard-fill-color.svg";
                    } else if (!response.data.type) {
                        this.comment.like = response.data.like;
                        this.image = "hard-fill.svg"
                    }
                }).catch((error) => {
                    this.image = temp;
                })
            },
            reply: function () {
                document.getElementById('pop-main').style.display = "block"
            },
            replyFun: function () {
                this.showReply = !this.showReply;
                if (this.showReply)
                    this.$parent.line += 78;
                else
                    this.$parent.line -= 78;
                // this.$parent.$parent.$children[0].line = lineHe(this.$parent.$parent.number,this.$parent.$parent.commentId);
            },
            createReply: function () {
                if (this.text !== '')
                    axios.post('api/create-comment', {
                        'text': this.text,
                        'comment_id': this.comment.id
                    }).then((response) => {
                        this.comment.replies.push(response.data);
                        this.$parent.commentCount++;
                        this.text = '';
                        this.replyFun();
                    })
            },
            deleteComment: function () {
                // console.log(this.$el.parentElement.children)
                axios.delete('/api/delete-comment/' + this.comment.id)
                    .then((response) => {
                        this.$parent.$parent.commentCount--;
                        this.$el.parentElement.children[2].innerHTML = ""
                        this.$el.innerHTML = ""
                    })
            },
            showEdit: function () {
                inkForm('edit-comment',this.comment.media);
            },
        },
        mounted() {
            if (this.comment.like)
                for (var i = 0; i < this.comment.like.length; i++)
                    if (this.comment.like[i].user_id === 1) {
                        this.image = "hard-fill-color.svg";
                    }
        }
    }
</script>

<style scoped>

</style>