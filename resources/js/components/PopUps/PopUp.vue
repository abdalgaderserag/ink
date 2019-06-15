<template>
    <div id="pop-main">
        <create-ink v-show="type === 'ink'"></create-ink>
        <add-comment v-show="type === 'reply'"></add-comment>
    </div>
</template>

<script>
    export default {
        name: "PopUp",
        data() {
            return {
                type: '',
            }
        }
    }
</script>

<style scoped>
</style>