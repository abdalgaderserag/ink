<template>
    <div class="pop-card">
        <h3>
            <img @click="hide" src="/images/back.png" alt="">
            <span>
                    Create Ink
                </span>
        </h3>
        <textarea v-model="text" cols="124" rows="6" class="text-input" v-on:focus="animate()"></textarea>
        <input type="file" v-on:change="upload" id="uploader">
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
                images: [],
                videos: [],
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
                        'images': this.images,
                        'videos': this.videos,
                    }).then((response) => {
                        this.hide();
                        this.text = '';
                        this.$root.$children[2].inks.push(response.data);
                        console.log(app.$children[2].inks);
                    })
            },
            addFile: function (data, type) {
                if (type === 'image') {
                    this.images.push(data)
                } else if (type === 'video') {
                    this.videos.push(data)
                }

            },
            upload: function (e) {
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function () {
                    axios.post('/api/upload', {
                        'file': reader.result,
                    }).then((response) => {
                        app.$children[0].$children[0].addFile(response.data.path, response.data.type);
                    }).catch((error) => {
                        console.log("error while uploading file :" + error)
                    })
                };
            }
        },
    }
</script>

<style scoped>

</style>