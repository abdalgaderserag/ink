<template>
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
                    <a @click="reply">Reply</a>
                    <a href="/share">Share</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentCard",
        data() {
            return {
                image: 'hard-fill.svg',
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
            reply: function () {
                document.getElementById('pop-main').style.display = "block"
            }
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