<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Edit Comment
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input">{{ media.text }}</textarea>
        <br>
        <button role="button" @click="editComment()">Edit</button>
    </div>
</template>

<script>
    export default {
        name: "EditComment",
        data() {
            return {
                text: '',
            }
        },
        props: {
            media: {
                type: Object,
                required: true,
            },
            number: {
                type: Number,
            },
            commentNumber: {
                type: Number,
            },
            replyId: {
                type: Number,
                default: null,
            }
        },
        methods: {
            hide: function () {
                let main = document.getElementById('pop-main');
                main.style.display = "none";
            },
            editComment: function () {
                if (this.text !== "")
                    axios.put('/api/edit-comment/' + this.media.id, {
                        'text': this.text,
                    }).then((response) => {
                        this.hide();
                        if (this.replyId === null)
                            app.$children[2].$children[this.number].$children[0].$children[this.commentNumber].comment.media.text = this.text;
                        else
                            app.$children[2].$children[this.number].$children[0].$children[this.commentNumber+1].$children[this.replyId].reply.media.text = this.text;
                        this.text = '';
                    })
            }
        }
    }
</script>

<style scoped>

</style>