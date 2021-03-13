<template>
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex flex-row">
                <a class="text-dark"
                    :href="ShowUserPath"
                >
                    <i class="fas fa-user-circle fa-3x"></i>
                </a>
                <div v-if="CheckSelf" class="ml-auto">
                    <button class="btn-sm shadow-none border border-primary p-2"
                        :class="buttonColor"
                        @click="clickFollow"
                    >
                        <i class="mr-1"
                            :class="buttonIcon"
                        ></i>
                        {{ buttonText }}
                    </button>
                </div>
            </div>
            <h2 class="h5 card-title m-0">
                <a class="text-dark"
                    :href="ShowUserPath"
                >
                    {{ UserName }}
                </a>
            </h2>
        </div>
        <div class="card-body">
            <div class="card-text">
                <a class="text-muted"
                    :href="FollowingsPath"
                >
                    {{ Followings }} フォロー
                </a>
                <a class="text-muted"
                    :href="FollowersPath"
                >
                    {{ Followers }} フォロワー
                </a>
            </div>
            <div class="text-right">
                <a href="/">TOPへ</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        initialIsFollowedBy: {
            type: Boolean, 
            default: false, 
        }, 
        authorized: {
            type: Boolean, 
            default: false, 
        }, 
        CheckSelf: {
            type: Boolean, 
            default: false, 
        }, 
        UserName: {
            type: String, 
            default: null, 
        }, 
        initialFollowings: {
            type: Number, 
            default: 0, 
        }, 
        initialFollowers: {
            type: Number, 
            default: 0, 
        }, 
        ShowUserPath: {
            type: String, 
        }, 
        FollowingsPath: {
            type: String, 
        }, 
        FollowersPath: {
            type: String, 
        }, 
        endpoint: {
            type: String, 
        }, 
    },
    data() {
        return {
            isFollowedBy: this.initialIsFollowedBy, 
            Followings: this.initialFollowings, 
            Followers: this.initialFollowers, 
        }
    }, 
    computed: {
        buttonColor() {
            return this.isFollowedBy
                ? 'bg-primary text-white'
                : 'bg-white'
            },
        buttonIcon() {
            return this.isFollowedBy
                ? 'fas fa-user-check'
                : 'fas fa-user-plus'
        },
        buttonText() {
            return this.isFollowedBy
                ? 'フォロー中'
                : 'フォロー'
        }, 
    }, 
    methods: {
        clickFollow() {
            if (!this.authorized) {
                alert('フォロー機能はログイン中のみ使用できます')
                return
            }

            this.isFollowedBy
                ? this.unfollow()
                : this.follow()
        }, 
        async follow() {
            const response = await axios.put(this.endpoint)
            this.Followers = response.data.followers
            this.isFollowedBy = true
        }, 
        async unfollow() {
            const response = await axios.delete(this.endpoint)
            this.Followers = response.data.followers
            this.isFollowedBy = false
        }, 
    },
}
</script>