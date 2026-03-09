import { createRouter, createWebHistory } from 'vue-router'
import Register from './pages/Register.vue'
import Login from './pages/Login.vue'
import Profile from './pages/Profile.vue'
import Artists from './pages/Artists.vue'
import Focus from './pages/Focus.vue'
import About from './pages/About.vue'


const routes = [
  { path: '/', component: Profile },
  { path: '/register', component: Register },
  { path: '/login', component: Login },

    { path: '/artists', component: Artists },
  { path: '/focus', component: Focus },
  { path: '/about', component: About },

]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router