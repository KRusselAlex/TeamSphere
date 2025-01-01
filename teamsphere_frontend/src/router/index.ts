import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/auth/LoginView.vue'
import RegisterView from '@/views/auth/RegisterView.vue'
import ForgotPassword from '@/views/auth/ForgotPassword.vue'
import ResetPassword from '@/views/auth/ResetPassword.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/auth',
      children: [
        { path: 'login', component: LoginView, name: 'login' },
        { path: 'register', component: RegisterView, name: 'register' },
        { path: 'forgot-password', component: ForgotPassword, name: 'forgot-password' },
        { path: 'reset-password', component: ResetPassword, name: 'resset-password' },
      ],
    },

  ],
})

export default router
