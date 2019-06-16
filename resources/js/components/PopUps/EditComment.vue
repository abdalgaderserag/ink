<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Edit Comment
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input">{{ media.text }}</textarea>
        <file-reader file="image" post="ink"></file-reader>
        <br>
        <button role="button" @click="submitInk()">Edit</button>
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
        props:{
            media:{
                type: Object,
                required: true,
            }
        },
        methods: {
            hide: function () {
                var main = document.getElementById('pop-main');
                main.style.display = "none";
            },
            submitInk: function () {
                if (this.text !== "")
                    axios.put('/api/edit-comment', {

                        'text': this.text,
                    }).then((response) => {
                        this.hide();
                        this.text = '';
                    })
            }
        }
    }
</script>

<style scoped>

</style>