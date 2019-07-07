<template>
    <input type="file" @change="upload" id="uploader">
</template>

<script>
    export default {
        name: "FileReader",
        methods:{
            upload: function (e) {
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function () {
                    axios.post('/api/upload', {
                        'file': reader.result,
                    }).then((response) => {
                        app.$children[0].$children[0].addFile(response.data.path);
                    }).catch((error) => {
                        console.log("error while uploading file :" + error)
                    })
                };
            }
        }
    }
</script>

<style scoped>

</style>