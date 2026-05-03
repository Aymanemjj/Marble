import { createApp } from 'vue'
import './style.css'
import MainLayout from './MainLayout.vue'
import { router } from './router'
import { createPinia } from 'pinia';


createApp(MainLayout).use(router).use(createPinia()).mount('#app')


