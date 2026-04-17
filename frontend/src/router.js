import { createRouter, createWebHistory } from 'vue-router'
import Register from './pages/Register.vue'
import Login from './pages/Login.vue'
import Profile from './pages/Profile.vue'
import Artists from './pages/Artists.vue'
import Focus from './pages/Focus.vue'
import About from './pages/About.vue'
import Home from './pages/Home.vue'
import PieceDetails from './pages/PieceDetails.vue'


const routes = [
  { path: '/', component: Home },
  { path: '/register', component: Register },
  { path: '/login', component: Login },
  { path: '/creator/:creatorType/:id', component: Profile },
  { path: '/artists', component: Artists },
  { path: '/focus', component: Focus },
  { path: '/about', component: About },
  {path: '/piece/:id', component: PieceDetails, props: true},
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router