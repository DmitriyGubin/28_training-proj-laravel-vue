import '../css/jquery.fancybox.min.css';
import './bootstrap';

//import jQuery from 'jquery';
import $ from 'jquery';
window.$ = jQuery;

//import 'slick-carousel';

import '@fancyapps/fancybox';

import 'jquery-mask-plugin';//npm i jquery-mask-plugin

import './index.js';

import {createApp} from 'vue';

import admin_posts from './vue/admin_posts.vue';
createApp(admin_posts).mount("#posts_box_admin");

import weather from './vue/weather.vue';
createApp(weather).mount("#weather_form");

import users from './vue/users/users_main.vue';
createApp(users).mount("#users_component_vue");

//console.log($.fancybox);











