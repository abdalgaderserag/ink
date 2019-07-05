<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Edit Ink
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
        name: "EditInk",
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
        },
        methods: {
            hide: function () {
                var main = document.getElementById('pop-main');
                main.style.display = "none";
            },
            submitInk: function () {
                if (this.text !== "")
                    axios.put('/api/edit-ink/' + this.media.id, {
                        'text': this.text,
                    }).then((response) => {
                        this.hide();
                        app.$children[2].inks[this.number].media.text = this.text;
                        this.text = '';
                    })
            }
        }
    }
</script>

<style scoped>

</style>