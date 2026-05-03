import { createRouter, createWebHistory } from 'vue-router'
import Register from './pages/Register.vue'
import Login from './pages/Login.vue'
import CreatorProfile from './pages/CreatorProfile.vue'
import Artists from './pages/Artists.vue'
import FocusSettings from './pages/FocusSettings.vue'
import About from './pages/About.vue'
import Home from './pages/Home.vue'
import PieceDetails from './pages/PieceDetails.vue'
import Gallery from './pages/Gallery.vue'
import FocusPiece from './pages/FocusPiece.vue'
import UnAuthenticated from './pages/UnAuthenticated.vue'
import UploadPiece from './pages/UploadPiece.vue'
import { useAuthStore } from './stores/useAuthStore'
import Profile from './pages/Profile.vue'
import AuthGallery from './pages/AuthGallery.vue'
import EditPiece from './pages/EditPiece.vue'
import ProfileEdit from './pages/ProfileEdit.vue'
import CollageCreate from './pages/CollageCreate.vue'
import CollageDetails from './pages/CollageDetails.vue'
import CollageEdit from './pages/CollageEdit.vue'
import Followers from './pages/Followers.vue'

const routes = [
  { path: '/', component: Home, name: 'Home', props: true },
  { path: '/register', component: Register, meta: { guestOnly: true } },
  { path: '/login', component: Login, meta: { guestOnly: true } },
  { path: '/creator/:creatorType/:id', component: CreatorProfile },
  { path: '/creator/:creatorType/:id/gallery', component: Gallery },
  { path: '/artists', component: Artists },
  { path: '/focus/settings', component: FocusSettings, meta: { requiresAuth: true } },
  { path: '/focus/piece', component: FocusPiece, meta: { requiresAuth: true } },
  { path: '/about', component: About },
  { path: '/piece/:id', component: PieceDetails, props: true },

  { path: '/upload', component: UploadPiece, meta: { requiresAuth: true } },
  { path: '/piece/:id/edit', component: EditPiece, meta: { requiresAuth: true } },

  { path: '/profile', component: Profile, meta: { requiresAuth: true } },
  { path: '/profile/gallery/pieces', component: AuthGallery, meta: { requiresAuth: true } },
  { path: '/profile/gallery/collages', component: AuthGallery, meta: { requiresAuth: true } },
  { path: '/profile/edit', component: ProfileEdit, meta: { requiresAuth: true } },
  { path: '/profile/followee', component: Followers, meta: { requiresAuth: true } },

  { path: '/collage/create', component: CollageCreate, meta: { requiresAuth: true } },
  { path: '/collage/:id/edit', component: CollageEdit, meta: { requiresAuth: true } },

  { path: '/collage/:id', component: CollageDetails },

  { path: '/unauth', component: UnAuthenticated, meta: { guestOnly: true } }

]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})



router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();
  await auth.initialize();

  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    next('/unauth');
  } else if (to.meta.guestOnly && auth.isAuthenticated) {
    next('/');
  } else {
    next();
  }
});

export default router