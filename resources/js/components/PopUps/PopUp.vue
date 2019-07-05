<template>
    <div id="pop-main">
        <create-ink v-show="type === 'ink'"></create-ink>
        <add-comment v-show="type === 'reply'"></add-comment>
        <edit-ink v-show="type === 'edit-ink'" :media="media" :number="number"></edit-ink>
        <edit-ink v-show="type === 'edit-comment'" :media="media"></edit-ink>
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
            }
        }, methods: {
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
                document.getElementsByClassName("pop-card")[intg].style.borderTopWidth = "6px";
            }
        }
    }
</script>

<style scoped>
</style>