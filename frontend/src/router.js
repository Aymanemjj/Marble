import { createRouter, createWebHistory } from 'vue-router'
import Register from './pages/Register.vue'
import Login from './pages/Login.vue'
import Profile from './pages/CreatorProfile.vue'
import Artists from './pages/Artists.vue'
import FocusSettings from './pages/FocusSettings.vue'
import About from './pages/About.vue'
import Home from './pages/Home.vue'
import PieceDetails from './pages/PieceDetails.vue'
import Gallery from './pages/Gallery.vue'
import FocusPiece from './pages/FocusPiece.vue'


const routes = [
  { path: '/', component: Home, name:'Home' , props: true},
  { path: '/register', component: Register },
  { path: '/login', component: Login },
  { path: '/creator/:creatorType/:id', component: Profile },
  { path: '/creator/:creatorType/:id/gallery', component: Gallery },
  { path: '/artists', component: Artists },
  { path: '/focus/off', component: FocusSettings },
  { path: '/focus/settings', component: FocusPiece },
  { path: '/about', component: About },
  { path: '/piece/:id', component: PieceDetails, props: true },

]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router