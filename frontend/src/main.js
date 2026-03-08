import { createApp } from 'vue'
import './style.css'
import MainLayout from './MainLayout.vue'
import { router } from './router'

createApp(MainLayout).use(router).mount('#app')
