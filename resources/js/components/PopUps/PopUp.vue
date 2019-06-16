<template>
    <div id="pop-main">
        <create-ink v-show="type === 'ink'"></create-ink>
        <add-comment v-show="type === 'reply'"></add-comment>
        <edit-ink v-show="type === 'edit-ink'" :media="media"></edit-ink>
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
            }
        }
    }
</script>

<style scoped>
</style>