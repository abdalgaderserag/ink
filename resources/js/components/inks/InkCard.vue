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
                <span>{{ ink.like.length }}</span>
                <img src="/images/comment.svg" width="36px" height="30px" alt="">
                <span>{{ commentCount }}</span>
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
                commentCount: 0,
                commentId: 0,
            }
        },
        props: {
            ink: {
                type: Object,
                required: true,
            },
            number: {
                type: Number,
                required: true,
            }
        },
        mounted() {
            for (var i = 0; i < this.ink.like.length; i++)
                if (this.ink.like[i].user_id === 1) {
                    this.image = "hard-fill-color.svg";
                }


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
                // console.log(this.number)
                this.$children[0].line = lineHe(this.number,this.commentId);
            }
        }
    }
</script>
