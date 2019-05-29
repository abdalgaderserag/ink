<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Create Ink
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input"></textarea>
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
            hide: function () {
                var main = document.getElementById('pop-main');
                main.style.display = "none";
            },
            submitInk: function () {
                axios.post('/api/create-ink',{
                    'api_token': this.$data.api_token,
                    'text': this.text,
                    'file': '',
                }).then((response)=>{
                    this.hide()
                    this.text = ''
                })
            }
        }
    }
</script>

<style scoped>

</style>