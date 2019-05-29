<template>
    <div class="comment flew-box">
        <img class="comment-avatar" src="/images/profile.jpeg" alt="">
        <div class="comment-card">
            <div class="comment-text">
                <span>{{ comment.user.name }}</span>
                <p>{{ comment.media[0].text }}</p>
                <div class="comment-footer">
                    <img src="/images/Hard-fill.svg" width="24px" alt="">
                    <span>12</span>
                    <img src="/images/comment.svg" width="24px" alt="">
                    <span>12</span>
                    <a href="/share">Share</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentCard",
        props:{
            comment:{
                type: Object,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>