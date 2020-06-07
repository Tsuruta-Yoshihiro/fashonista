
import './bootstrap'
import Vue from 'vue'
import Like from './components/Like'


require('./bootstrap');


const app = new Vue({
    el: '#app',
    components: {
      Like,
      
    }
});
