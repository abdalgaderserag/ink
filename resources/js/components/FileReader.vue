<template>
    <input type="file" v-on:change="upload" id="uploader">
</template>

<script>
    export default {
        name: "FileReader",
        data(){
            return{
                images:[],
            }
        },
        props:{
            file:{
                type: String,
                required: true,
            },
            post:{
                type: String,
                required: true,
            }
        },
        methods:{
            upload: function (e) {
                var reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function(){
                    app.$data.images.push(reader.result)
                    app.$data.imageNames.push(e.target.files[0].name);
                    axios.post('/api/upload',{
                        'file': reader.result,
                        'post': app.$children[0].$children[0].$children[0].post,
                    }).then((response)=>{
                        console.log(response.data)
                    }).catch((error)=>{
                        console.log("error while uploading file :" + error)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>