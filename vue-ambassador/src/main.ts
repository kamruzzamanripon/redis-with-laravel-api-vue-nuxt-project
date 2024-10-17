import './assets/main.css'

import axios from "axios"
import { createPinia } from 'pinia'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

axios.defaults.baseURL = 'http://localhost:8000/api/ambassador/';
axios.defaults.withCredentials = true;

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
