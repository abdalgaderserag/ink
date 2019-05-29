<template>
    <input type="file" v-on:change="upload" id="uploader">
</template>

<script>
    export default {
        name: "FileReader",
        data(){
            return{
                images:[],
                // image:'',
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
                // console.log(e.target.files[0].name)
                reader.onload = function(){
                    app.$data.images.push(reader.result)
                    app.$data.imageNames.push(e.target.files[0].name);
                    axios.post('/api/' + app.$children[0].$children[0].$children[0].file,{
                        'api_token': app.$data.api_token,
                        'file': reader.result,
                        'post': app.$children[0].$children[0].$children[0].post,
                    }).then((response)=>{
                        console.log(response.data)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>