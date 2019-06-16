<template>
    <div class="comment reply flew-box">
        <img class="comment-avatar" src="/images/profile.jpeg" alt="">
        <div class="comment-card">
            <div class="comment-text">
                <span>{{ reply.user.name }}</span>
                <div v-for="media in reply.media">
                    <p>{{ media.text }}</p>
                </div>
                <div class="comment-footer">
                    <img :src="'/images/' + image" @click="like" width="24px" alt="">
                    <span>{{ reply.like.length }}</span>
                    <!--<img src="/images/comment.svg" width="36px" height="30px" alt="">-->
                    <!--<span>12</span>-->
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
            }
        },
        props: {
            reply: {
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
                    .then((response)=>{
                        // this.$el = ""
                        this.$el.parentElement.innerHTML = ""
                    })
            },
            showEdit: function () {
                inkForm('edit-comment',this.reply.media);
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