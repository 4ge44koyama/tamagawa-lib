import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/module/ArticleLike'
import FileInput from './components/module/FileInput'
import UserCard from './components/module/UserCard'
import FollowButton from './components/module/FollowButton'

const app = new Vue({
    el: '#app',
    components: {
        ArticleLike, 
        FileInput, 
        UserCard, 
        FollowButton, 
    }
})