import { createRouter, createWebHistory } from 'vue-router'
import Register from './pages/Register.vue'


const routes = [
  { path: '/register', component: Register },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})