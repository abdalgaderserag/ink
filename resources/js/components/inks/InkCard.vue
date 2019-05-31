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

        <div class="card-body" @click="showComments()">
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
                <img :src="'/images/' + image" @click="like()" width="28px" height="24px" alt="">
                <span>312</span>
                <img src="/images/comment.svg" width="36px" height="30px" alt="">
                <span>43</span>
            </div>
        </div>
        <comments :id="ink.id" :show="show"></comments>
    </div>
</template>

<script>
    export default {
        name: "InkCard",
        data() {
            return {
                show: false,
                image: "hard-fill.svg",
            }
        },
        props: {
            ink: {
                type: Object,
                required: true,
            },
        },
        mounted() {
            axios({
                method: 'post',
                url: '/api/like/check',
                data: {
                    'ink_id': this.ink.id,
                },
                header:{
                    'Accept': 'application/json',
                    'Authorization': 'Bearer 79ff0a4eeafbeb8ec37192dec2883ae6bae922a8815a13e6daaacd624eab4a1e0c17b7bb4ba4dc50',
                },
            }).then((response) => {
                if (response.data)
                    this.image = "hard-fill-color.svg"
                else
                    this.image = "hard-fill.svg"
            })
        },
        methods: {
            like: function () {
                axios.post('/api/like', {
                    'ink_id': this.ink.id,
                }).then((response) => {
                    if (response.data) {
                        this.image = "hard-fill-color.svg"
                    } else {
                        this.image = "hard-fill.svg"
                    }
                })
            },
            showComments: function () {
                this.show = !this.show;
            }
        }
    }
</script>
