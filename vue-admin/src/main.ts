import './assets/main.css'


import { createPinia } from 'pinia'
import { createApp } from 'vue'

import axios from "axios"
import App from './App.vue'
import router from './router'


axios.defaults.baseURL = 'http://localhost:8000/api/admin/';
axios.defaults.withCredentials = true;

//Vue.config.productionTip = false

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
