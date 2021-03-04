import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import FileInput from './components/FileInput'
import UserCard from './components/UserCard'

const app = new Vue({
    el: '#app',
    components: {
        ArticleLike, 
        FileInput, 
        UserCard, 
    }
})