<template>
    <div class="comments-main" v-show="show">
        <hr id="comments-line" ref="line" :style="{height:line + 'px'}">
        <div v-for="comment in comments">
            <comment-card :comment="comment"></comment-card>
            <replies-card v-show="comment.replies" :replies="comment.replies"></replies-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comments",
        data() {
            return {
                line: 0,
                comments: [],
            }
        },
        mounted() {
            axios.get('/api/show-ink/' + this.id)
                .then((response) => {
                    this.comments = response.data;
                })
        },
        props: {
            show: {
                type: Boolean,
                required: true,
            },
            id: {
                type: Number,
                required: true,
            }
        },
        methods: {
            lineHeigth: function () {
                this.line = this.$refs.last.$el.offsetTop - this.$refs.line.offsetTop;
            },
            styleChenged: function () {
                axios.get()
                this.lineHeigth()
            }
        }
    }
</script>

<style scoped>

</style>