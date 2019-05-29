<template>
    <div class="ink-card">
        <img v-bind:src="ink.user.avatar" class="card-avatar">
        <div class="card-title">
            <span class="name-slug">
                <a v-bind:href="'/profile/' + ink.user.slug">
                    <span>{{ ink.user.name }}</span>
                </a>
                <br>
                <span>{{ '@' + ink.user.slug }}</span>
            </span>
        </div>

        <div class="card-body">
            <p>{{ ink.media[0].text }}</p>
            <div v-show="ink.media[0].images != null || ink.media[0].videos != null"
                 class="media">
                <div class="images">
                    <img src="" alt="">
                </div>
                <div class="videos">
                    <video src=""></video>
                </div>
            </div>
            <div class="card-footer">
                <img src="/images/hard-fill.svg" width="28px" height="24px" alt="">
                <span>312</span>
                <img src="/images/hard-fill-color.svg" width="28px" height="24px" alt="">
                <span>43</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileInkCard",
        props: {
            ink: {
                type: Object,
                required: true,
            }
        }
    }
</script>

<style scoped>
    .ink-card {
        margin-top: 20px;
    }

    .ink-card .card-avatar {
        width: 100px;
        border-radius: 50%;
        border: 2px solid #f98835;
        float: left;
        position: absolute;
        left: 152px;
    }

    .ink-card .card-title {
        margin-left: 124px;
    }

    .ink-card .card-title .name-slug {
        position: relative;
        top: 10px;
        width: auto;
    }

    .ink-card .card-title .name-slug span {
        font-weight: 700;
        font-size: 14px;
        color: #b2b2b2;
    }

    .ink-card .card-title .name-slug span:first-child {
        color: #f98835;
        font-size: 18px;
    }

    .ink-card .card-body {
        font-size: 28px;
        border: 2px solid #f98835;
        padding: 36px 20px 12px 20px;
        border-radius: 4px;
        margin-top: 12px;
    }

    .ink-card .card-body p {
        margin: 20px 0 0 0;

    }

    .ink-card .card-body span {
        font-size: 18px;
    }

    .ink-card .card-body .images {
        padding: 8px 20px 4px 20px;
        border-radius: 8px;
        display: flex;
    }

    .ink-card .card-body .images img {
        flex-grow: 1;
    }

    .ink-card .card-body .videos {
        padding: 8px 20px 4px 20px;
        border-radius: 8px;
        display: flex;
    }

    .ink-card .card-body .videos video {
        flex-grow: 1;
    }

    .ink-card .card-body .card-footer {
        color: #b2b2b2;
        font-size: 20px;
        margin-top: 12px;
        vertical-align: center;
    }
</style>
