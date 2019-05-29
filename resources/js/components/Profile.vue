<template>
    <div>
        <div class="wallpaper">
            <img src="/images/profile-image.png" alt="">
        </div>
        <div class="w-line">
            {{ $user->name }}
        </div>
        <img src="/images/profile.jpeg" class="profile-avatar" alt="">

        <div class="flew-box profile-details">
            <div class="flew-box">
                <span>Follower</span>
                23
            </div>
            <div class="flew-box">
                <span>Followed</span>
                12
            </div>
            <div>
                <button>
                    Follow
                </button>
            </div>
        </div>
        <p class="details">loaslkd;j salj dklwg;kahgsok ;hpgdja;lajg lakgh;kaghklh ;koaglh</p>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        data() {
            return {
                user: [],
            }
        },
        mounted() {
            axios.get('/api/user').then((response)=>{
                console.log(response.data)
            })
        }
    }
</script>

<style scoped>

</style>