<template>
    <div class="comment reply flew-box">
        <img class="comment-avatar" :src="reply.user.avatar" alt="">
        <div class="comment-card">
            <div class="comment-text" :class="{'reply-text' : last}">
                <span>{{ reply.user.name }}</span>
                <div v-if="reply.media">
                    <p>{{ reply.media.text }}</p>
                </div>
                <div class="comment-footer">
                    <img :src="'/images/' + image" @click="like" width="24px" alt="">
                    <span>{{ reply.like.length }}</span>
                    <a href="/share">Share</a>
                    <a v-show="reply.user.slug == $root.slug" @click="deleteReply()">delete</a>
                    <a v-show="reply.user.slug == $root.slug" @click="showEdit()">edit</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReplyCard",
        data() {
            return {
                image: 'hard-fill.svg',
                last: false,
            }
        },
        props: {
            reply: {
                type: Object,
                required: true,
            },
            id: {
                type: Number,
                required: true
            }
        },
        mounted() {
            this.last = this.$parent.replies.length - 1 === this.id;
            console.log(this.last + "\n")
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
                    'comment_id': this.reply.id,
                    'type': 'reply',
                }).then((response) => {
                    if (response.data.type) {
                        this.reply.like.push(response.data.like);
                        this.image = "hard-fill-color.svg";
                    } else if (!response.data.type) {
                        this.reply.like = response.data.like;
                        this.image = "hard-fill.svg"
                    }
                }).catch((error) => {
                    this.image = temp;
                })
            },
            deleteReply: function () {
                axios.delete('/api/delete-comment/' + this.reply.id)
                    .then((response) => {
                        // this.$el = ""
                        this.$el.parentElement.innerHTML = ""
                    })
            },
            showEdit: function () {
                inkForm('edit-comment',
                    this.reply.media,
                    this.$parent.$parent.$parent.number,
                    this.$parent.$parent.number,
                    this.id);
            },
        },
        mounted() {
            if (this.reply.like)
                for (var i = 0; i < this.reply.like.length; i++)
                    if (this.reply.like[i].user_id === 1) {
                        this.image = "hard-fill-color.svg";
                    }
        }
    }
</script>

<style scoped>

</style>