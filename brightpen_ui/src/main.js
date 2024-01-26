import { createApp } from 'vue'
import router from './routes'

import './axios'
// import './style.css'
import './assets/tailwind.css'
import App from './App.vue'

const app = createApp(App);
app.use(router)

app.mount('#app')