<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Create Ink
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input" v-on:focus="animate()"></textarea>
        <file-reader file="image" post="ink"></file-reader>
        <!--<input type="button" value="Ink It !">-->
        <br>
        <button role="button" @click="submitInk()">Ink it!</button>
    </div>
</template>

<script>

    export default {
        name: "CreateInk",
        data() {
            return {
                text: '',
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
                if (this.text !== "")
                    axios.post('/api/create-ink', {
                        'text': this.text,
                        'file': '',
                    }).then((response) => {
                        this.hide();
                        this.text = '';
                    })
            }
        },
        activated() {
            document.getElementsByClassName("pop-card")[0].style.borderTopWidth = "6px";
        }
    }
</script>

<style scoped>

</style>