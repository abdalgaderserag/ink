<template>
    <div id="pop-main">
        <create-ink v-if="type === 'ink'"></create-ink>
        <add-comment v-if="type === 'reply'"></add-comment>
        <edit-ink v-if="type === 'edit-ink'" :media="media" :number="number"></edit-ink>
        <edit-comment v-if="type === 'edit-comment'" :media="media" :number="number"
                      :commentNumber="commentNumber" :replyId="replyId"></edit-comment>
        <media-display v-else :media="type"></media-display>
    </div>
</template>

<script>
    export default {
        name: "PopUp",
        data() {
            return {
                type: '',
                media: {},
                number: 0,
                commentNumber: 0,
                replyId: null,
            }
        },
        updated() {
            this.apper();
        },
        methods: {
            apper: function () {
                let intg;
                switch (this.type) {
                    case "ink" :
                        intg = 0;
                        break;
                    case "reply" :
                        intg = 1;
                        break;
                    case "edit-ink" :
                        intg = 2;
                        break;
                    case "edit-comment" :
                        intg = 4;
                        break;
                }
            }
        }
    }
</script>

<style scoped>
</style>