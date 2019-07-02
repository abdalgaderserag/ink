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
            <img v-show="editAble" :src="'/images/' + image" @click="showEdit()" width="28px" height="24px" alt="">
            <img v-show="deleteAble" :src="'/images/' + image" @click="deleteInk()"
                 style="float: right;margin-right: 20px" width="28px" height="24px" alt="">
        </div>

        <div class="card-body">
            <p @click="showComments()">{{ ink.media[0].text }}</p>
            <div v-show="ink.media[0].images != null || ink.media[0].videos != null"
                 class="media">
                <div class="images">
                    <img :src="ink.media[0].images" alt="">
                    {{ ink.media[0].images}}
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
                deleteAble: this.$root.slug == this.ink.user.slug,
                editAble: this.$root.slug == this.ink.user.slug,
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
                if (this.ink.like[i].user_id + '' === this.$root.id)
                    this.image = "hard-fill-color.svg";
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
                    'ink_id': this.ink.id,
                    'type': 'ink',
                }).then((response) => {
                    if (response.data.type) {
                        this.ink.like.push(response.data.like);
                        this.image = "hard-fill-color.svg";
                    } else if (!response.data.type) {
                        this.ink.like = response.data.like;
                        this.image = "hard-fill.svg"
                    }
                }).catch((error) => {
                    this.image = temp;
                })
            },
            showComments: function () {
                let scrS;
                this.show = !this.show;
                if (this.$children[0].comments.length != 0)
                    this.$children[0].line = lineHe(this.number, this.commentId);
                if (this.show) {
                    scrS = window.scrollY;
                    let inks = document.getElementsByClassName('ink-card');
                    for (var i = 0; i < inks.length; i++) {
                        if (i !== this.number) {
                            inks[i].style.display = "none"
                        }
                    }
                } else {
                    let inks = document.getElementsByClassName('ink-card');
                    window.scrollY = scrS;
                    for (var i = 0; i < inks.length; i++) {
                        if (i !== this.number) {
                            inks[i].style.display = "block"
                        }
                    }
                }

            },
            deleteInk: function () {
                axios.delete('/api/delete-ink/' + this.ink.id)
                    .then((response) => {
                        this.$el.innerHTML = ""
                    })
            },
            showEdit: function () {
                inkForm('edit-ink',this.ink.media)
            },
            editInk: function () {
                axios.put('/api/edit-ink/' + this.ink.id,{

                })
                    .then((response) => {
                        this.$el.innerHTML = ""
                    })
            }
        }
    }
</script>
