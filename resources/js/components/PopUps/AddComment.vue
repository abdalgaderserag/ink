<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Create Reply
                </span>
        </h3>
        <div id="reply-section">
        </div>
        <textarea v-model="text" cols="124" rows="6" class="text-input"></textarea>
        <file-reader file="image" post="ink"></file-reader>
        <br>
        <button role="button" @click="submitInk()">reply</button>
    </div>
</template>

<script>
    export default {
        name: "AddComment",
        data() {
            return {
                text: '',
            }
        },
        methods:
            {
                hide: function () {
                    var main = document.getElementById('pop-main');
                    main.style.display = "none";
                }
                ,
                submitInk: function () {
                    axios.post('/api/create-ink', {
                        'text': this.text,
                    }).then((response) => {
                        this.hide();
                        this.text = ''
                    })
                }
            }
    }
</script>