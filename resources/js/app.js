require('./bootstrap');
import { createApp } from 'vue'

import axios from 'axios'
import VueAxios from 'vue-axios'

import VueQrcodeReader from "vue3-qrcode-reader";

import Vant from 'vant';
import 'vant/lib/index.css';

import NaiveUI from 'naive-ui'

import App from './App.vue'

import 'tailwindcss'

// import "../css/app.css"

import store from './store'

import router from './router.js'

import HtmlToPaper from "./plugins/htmltopeper.js";


let app = createApp(App)

app.use(store)
app.use(VueAxios, axios)
app.provide('axios', app.config.globalProperties.axios) 
app.use(VueQrcodeReader)
app.use(router)
app.use(Vant)
app.use(NaiveUI)
app.use(HtmlToPaper)
app.mount('#app')