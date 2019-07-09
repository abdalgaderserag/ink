<template>
    <div class="ink-card">
        <img v-bind:src="ink.user.avatar" class="card-avatar">
        <div class="card-title">
            <div>
                <img src="/images/back.png" v-show="show" class="back" @click="showComments" alt="">
            </div>
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
            <div v-if="ink.media.text != null">
                <p v-html="ink.media.text" @click="showComments"></p>
            </div>


            <div class="media">
                <div v-if="ink.media.media.length <= 3">
                    <div @click="showComments" v-for="media in ink.media.media" :style="'float: left;background: url('+ media +') center / cover;width: '+
                    (100/ink.media.media.length)+'%;'" class="ink-media"></div>
                </div>
                <div v-else v-for="(media,index) in ink.media.media">
                    <div v-if="index < 3" @click="showComments" :style="'float: left;background: url('+ media +') center / cover;width: '+
                    (100/3)+'%;'" class="ink-media"></div>
                    <div v-else @click="showComments" :style="'float: left;background: url('+ media +') center / cover;width: '+
                    (100/(ink.media.media.length - 3))+'%;'" class="ink-media"></div>
                </div>

                <!--<img v-for="(media,index) in ink.media.media" v-if="ink.media.media != null || ink.media.media != null"-->
                <!--:src="media" :width="imgWidth(media.length,index)" alt="">-->
            </div>


            <div class="card-footer">
                <img :src="'/images/' + image" @click="like()" width="28px" height="24px" alt="">
                <span>{{ ink.like.length }}</span>
                <img src="/images/comment.svg" width="36px" height="30px" alt="">
                <span>{{ commentCount }}</span>
                <span class="time">{{ ink.created_at }}</span>
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
                widthArray: [],
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
            for (let i = 0; i < this.ink.like.length; i++)
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

            this.widthMedia();

        },
        updated() {
            this.calLine()
        },
        methods: {
            widthMedia: function () {
                let mediaHTML = this.$el.getElementsByClassName('ink-media');

                let radius = "16px";
                mediaHTML[0].style.borderTopLeftRadius = radius;
                let number = this.ink.media.media.length;
                let height = 302;
                if (number === 1) {
                    mediaHTML[0].style.borderTopRightRadius = radius;
                    mediaHTML[0].style.borderBottomLeftRadius = radius;
                    height = mediaHTML[0].offsetWidth / 2;
                } else if (number === 2) {
                    mediaHTML[1].style.borderTopRightRadius = radius;
                    mediaHTML[0].style.borderBottomLeftRadius = radius;
                    height = mediaHTML[0].offsetWidth;
                } else if (number === 3) {
                    mediaHTML[2].style.borderTopRightRadius = radius;
                    mediaHTML[0].style.borderBottomLeftRadius = radius;
                    height = (mediaHTML[0].offsetWidth * 3) / 2;
                } else if (number === 4) {
                    mediaHTML[2].style.borderTopRightRadius = radius;
                    mediaHTML[3].style.borderBottomLeftRadius = radius;
                    height = mediaHTML[3].offsetWidth / 3;
                } else if (number === 5) {
                    mediaHTML[2].style.borderTopRightRadius = radius;
                    mediaHTML[3].style.borderBottomLeftRadius = radius;
                    height = (mediaHTML[3].offsetWidth * 2) / 3;
                } else if (number === 6) {
                    mediaHTML[2].style.borderTopRightRadius = radius;
                    mediaHTML[3].style.borderBottomLeftRadius = radius;
                    height = (mediaHTML[3].offsetWidth * 3) / 5;
                } else if (number > 6) {
                    mediaHTML[5].className += 'more-media'
                }
                mediaHTML[mediaHTML.length - 1].style.borderBottomRightRadius = radius;

                for (let i = 0; i < mediaHTML.length; i++) {
                    mediaHTML[i].style.height = height + 'px';
                }
            },
            calLine: function () {
                if (this.$children[0].comments.length != 0 && this.show)
                    this.$children[0].line = lineHe(this.number, this.commentId);
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
            sharpBorder: function (media) {
                media.style.borderBottomLeftRadius = "";
                media.style.borderBottomRightRadius = "";
                media.style.borderTopLeftRadius = "";
                media.style.borderTopRightRadius = "";

            },
            showComments: function (e) {

                if (e.path[0].className === 'ink-media' && this.show)
                    return;

                this.show = !this.show;


                if (this.show) {
                    let inks = document.getElementsByClassName('ink-card');
                    for (let i = 0; i < inks.length; i++) {
                        if (i !== this.number) {
                            inks[i].style.display = "none"
                        }
                    }

                    let mediaHTML = this.$el.getElementsByClassName('ink-media');
                    for (let i = 0; i < mediaHTML.length; i++) {
                        this.widthArray[i] = mediaHTML[i].offsetWidth;
                        mediaHTML[i].style.width = "100%";
                        this.sharpBorder(mediaHTML[i]);
                    }


                } else {


                    let inks = document.getElementsByClassName('ink-card');
                    let mediaHTML = this.$el.getElementsByClassName('ink-media');
                    for (let i = 0; i < mediaHTML.length; i++) {
                        // mediaHTML[i].style.borderBottomLeftRadius = "";
                        // mediaHTML[i].style.borderBottomRightRadius = "";
                        // mediaHTML[i].style.borderTopLeftRadius = "";
                        // mediaHTML[i].style.borderTopRightRadius = "";
                        mediaHTML[i].style.width = this.widthArray[i] + "px";
                    }


                    for (let i = 0; i < inks.length; i++) {
                        if (i !== this.number) {
                            inks[i].style.display = "block"
                        }
                    }


                    this.widthMedia();
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
    /*.ink-image:first-child{*/
    /*border-top-right-radius: 20px;*/
    /*}*/

    .more-media {
        background-color: rgba(13, 9, 27, 0.3);
    }

    .back {
        background-color: white;
        position: fixed;
        left: 40px;
        top: 150px;
        padding: 0 6px;
        border-radius: 18px;
        box-shadow: 0 1px 4px #b2b2b2;
    }
</style>