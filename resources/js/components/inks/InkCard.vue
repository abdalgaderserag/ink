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
            <img v-show="deleteAble" src="/images/cross.svg" @click="deleteInk()"
                 style="float: right;margin-right: 20px;" class="card-icon" width="20px" alt="">
            <span v-show="editAble" class="card-icon" style="float: right;margin-right: 12px;height: 16.966px"
                  @click="showEdit()">Edit</span>

        </div>

        <div class="card-body">
            <!--TODO : remove the if (false)-->
            <span v-if="false" class="time">{{ ink.created_at }}</span>
            <div v-if="ink.media.text != null">
                <p v-html="ink.media.text" @click="showComments()"></p>
            </div>


            <div class="media">
                <img v-for="(image,index) in images" v-if="ink.media.media != null || ink.media.media != null"
                     :src="image" :width="imgWidth(images.length,index)" alt="">
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
                images:
                    [
                        'images/profiles/20190511_235056.jpg',
                        'images/profiles/20190511_235056.jpg',
                        'images/profiles/20190511_235056.jpg',
                        'images/profiles/20190511_235056.jpg',

                    ],
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

            let media = document.getElementsByClassName('media')[this.number].children;
            if (media.length) {
                if (media.length > 3) {
                    for (let i = 3; i < media.length; i++) {
                        media[i].height = media[0].height;
                    }
                }
            }

            let timer = document.getElementsByClassName('time');

            for (let j = 0; j < timer.length; j++) {
                timer[j].style.top = (timer[j].offsetTop - 5) + 'px';
            }


        },
        updated() {
            this.calLine()
        },
        methods: {
            calLine: function () {
                if (this.$children[0].comments.length != 0 && this.show)
                    this.$children[0].line = lineHe(this.number, this.commentId);
            },
            imgWidth: function (length, firstLine) {
                let width = 100;
                if (length <= 3) {
                    width = width / length;
                } else if (length > 3) {
                    if (firstLine < 3) {
                        width = width / 3;
                    } else {
                        if (length === 4) {
                            return width + '%';
                        } else if (length === 5) {
                            return width / 2 + '%';
                        } else if (length === 6) {
                            return width / 3 + '%';
                        }
                    }

                }
                return width + '%';
            },
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

                if (this.show) {
                    let inks = document.getElementsByClassName('ink-card');
                    for (var i = 0; i < inks.length; i++) {
                        if (i !== this.number) {
                            inks[i].style.display = "none"
                        }
                    }
                } else {
                    let inks = document.getElementsByClassName('ink-card');
                    for (let i = 0; i < inks.length; i++) {
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
                inkForm('edit-ink', this.ink.media, this.number)
            },
            editInk: function () {
                axios.put('/api/edit-ink/' + this.ink.id, {})
                    .then((response) => {
                        this.$el.innerHTML = ""
                    })
            },
        }
    }
</script>

<style scoped>
    .media {
        width: 100%;
        margin-top: 34px;
    }

    .media img {
        float: left;
        max-height: 800px;
    }

    .media img:first-child {
        border-top-left-radius: 14px;
    }

    .media img:last-child {
        float: unset;
        border-bottom-right-radius: 14px;
    }
</style>