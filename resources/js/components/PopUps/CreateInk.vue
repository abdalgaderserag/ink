<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Create Ink
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input" v-on:focus="animate()"></textarea>
        <file-reader></file-reader>
        <br>
        <button role="button" @click="submitInk()">Ink it!</button>
    </div>
</template>

<script>
    let images = [];
    export default {
        name: "CreateInk",
        data() {
            return {
                text: '',
                media: [],
        }
        },
        methods: {
            animate: function () {
                document.getElementsByClassName("pop-card")[0].style.borderTopWidth = "6px";
            },
            hide: function () {
                var main = document.getElementById('pop-main');
                document.getElementsByClassName("pop-card")[0].style.borderTopWidth = "280px";
                main.style.display = "none";
            },
            submitInk: function () {
                if (this.text !== "" || this.images !== [] || this.videos !== [])
                    axios.post('/api/create-ink', {
                        'text': this.text,
                        'media': this.media,
                    }).then((response) => {
                        this.hide();
                        this.text = '';
                        this.$root.$children[2].inks.push(response.data);
                        this.media = [];
                    })
            },
            addFile: function (data) {
                    this.media.push(data)

            },
        },
    }
</script>

<style scoped>

</style>