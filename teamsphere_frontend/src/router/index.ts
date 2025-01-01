import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/auth/LoginView.vue'
import RegisterView from '@/views/auth/RegisterView.vue'
import ForgotPassword from '@/views/auth/ForgotPassword.vue'
import ResetPassword from '@/views/auth/ResetPassword.vue'
import DashboardView from '@/views/dashboard/DashboardView.vue'
import CreatePermission from '@/views/dashboard/Permission/CreatePermission.vue'
import EditPermission from '@/views/dashboard/Permission/EditPermission.vue'
import ViewAllPermissions from '@/views/dashboard/Permission/ViewAllPermissions.vue'
import ViewOnePermission from '@/views/dashboard/Permission/ViewOnePermission.vue'
import ProfilePage from '@/views/dashboard/Profile/ProfilePage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/dashboard',
      children: [
        {
          path: '', // Default child route
          name: 'dashboard.home',
          component: DashboardView, // Component to show when navigating to `/dashboard`
        },
        {
          path: 'permissions',
          name: 'permissions.viewAll',
          component: ViewAllPermissions,
        },
        {
          path: 'permissions/create',
          name: 'permissions.create',
          component: CreatePermission,
        },
        {
          path: 'permissions/update',
          name: 'permissions.update',
          component: EditPermission,
        },
        {
          path: 'permissions/view-one/:id',
          name: 'permissions.viewOne',
          component: ViewOnePermission,
        },
        {
          path: 'profile',
          name: 'profile',
          component: ProfilePage
        },

      ],
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
