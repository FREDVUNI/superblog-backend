require("./bootstrap");
window.Vue = require("vue").default

import { createApp } from 'vue'

import Form from "./form"
window.Form = Form

import App from './components/App.vue'
import router from './router'

const app = createApp(App)

app.use(router).mount('#app') 