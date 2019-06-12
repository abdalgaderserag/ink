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
                    <span>{{ reply.likes.length }}</span>
                    <!--<img src="/images/comment.svg" width="36px" height="30px" alt="">-->
                    <!--<span>12</span>-->
                    <a href="/share">Share</a>
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
                axios.post('/api/like', {
                    'comment_id': this.comment.id,
                    'type': 'comment',
                }).then((response) => {
                    if (response.data) {
                        this.image = "hard-fill-color.svg"
                    } else {
                        this.image = "hard-fill.svg"
                    }
                })
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