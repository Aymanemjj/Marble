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
import UnAuthenticated from './pages/UnAuthenticated.vue'
import { useAuthStore } from './stores/useAuthStore'

const routes = [
  { path: '/', component: Home, name: 'Home', props: true },
  { path: '/register', component: Register, meta: { guestOnly: true } },
  { path: '/login', component: Login, meta: { guestOnly: true } },
  { path: '/creator/:creatorType/:id', component: Profile },
  { path: '/creator/:creatorType/:id/gallery', component: Gallery },
  { path: '/artists', component: Artists },
  { path: '/focus/settings', component: FocusSettings, meta: { requiresAuth: true } },
  { path: '/focus/piece', component: FocusPiece, meta: { requiresAuth: true } },
  { path: '/about', component: About },
  { path: '/piece/:id', component: PieceDetails, props: true },

  { path: '/unauth', component: UnAuthenticated, meta: { guestOnly: true } }

]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})


router.beforeEach((to, from, next) => {
  const auth = useAuthStore();

  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    next('/unauth');
  } else if (to.meta.guestOnly && auth.isAuthenticated) {
    next('/'); 
  } else {
    next();
  }
});

export default router