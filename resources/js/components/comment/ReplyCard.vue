<template>
    <div class="comment reply flew-box">
        <img class="comment-avatar" src="/images/profile.jpeg" alt="">
        <div class="comment-card">
            <div class="comment-text">
                <span>Gadora Serag</span>
                <div v-for="media in reply.media">
                    <p>{{ media.text }}</p>
                </div>
                <div class="comment-footer">
                    <img src="/images/Hard-fill.svg" width="24px" alt="">
                    <span>12</span>
                    <img src="/images/comment.svg" width="36px" height="30px" alt="">
                    <span>12</span>
                    <a href="/share">Share</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReplyCard",
        props: {
            reply: {
                type: Object,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>