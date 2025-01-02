import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/auth/LoginView.vue'
import RegisterView from '@/views/auth/RegisterView.vue'
import ForgotPassword from '@/views/auth/ForgotPassword.vue'
import ResetPassword from '@/views/auth/ResetPassword.vue'
import DashboardView from '@/views/dashboard/DashboardView.vue'
import CreatePermission from '@/views/dashboard/permission/CreatePermission.vue'
import ViewAllPermissions from '@/views/dashboard/permission/ViewAllPermissions.vue'
import ViewOnePermission from '@/views/dashboard/permission/ViewOnePermission.vue'
import ProfilePage from '@/views/dashboard/Profile/ProfilePage.vue'
import AllPresence from '@/views/dashboard/presence/AllPresence.vue'
import MarkedPresence from '@/views/dashboard/presence/MarkedPresence.vue'
import AddUsers from '@/views/dashboard/users/AddUsers.vue'
import AllUsers from '@/views/dashboard/users/AllUsers.vue'
import EditUsers from '@/views/dashboard/users/EditUsers.vue'
import { decryptData } from '@/api/tokenEncryption';
import ViewOnePresence from '@/views/dashboard/presence/ViewOnePresence.vue'

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
          path: '',
          name: 'dashboard.home',
          component: DashboardView,
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
          path: 'permissions/:id',
          name: 'permissions.viewOne',
          component: ViewOnePermission,
        },
        {
          path: 'profile',
          name: 'profile',
          component: ProfilePage
        },
        {
          path: 'attendances',
          name: 'attendances',
          component: AllPresence
        },
        {
          path: 'attendances/mark',
          name: 'attendances/mark',
          component: MarkedPresence
        },
        {
          path: 'attendances/:id',
          name: 'attendances-one',
          component: ViewOnePresence
        },
        {
          path: 'users/create',
          name: 'usere-create',
          component: AddUsers
        },
        {
          path: 'users/view',
          name: 'usere-view',
          component: AllUsers
        },
        {
          path: 'users/edit',
          name: 'usere-edit',
          component: EditUsers
        },
      ],
    },
    {
      path: '/auth',
      children: [
        { path: 'login', component: LoginView, name: 'login' },
        { path: 'register', component: RegisterView, name: 'register' },
        { path: 'forgot-password', component: ForgotPassword, name: 'forgot-password' },
        { path: 'reset-password', component: ResetPassword, name: 'reset-password' },
      ],
    },
  ],
})


router.beforeEach((to, from, next) => {
  if (to.path.startsWith('/auth')) {
    return next();
  }

  const decryptedData = decryptData();
  if (decryptedData) {
    const [decryptedToken, decryptedId] = decryptedData;

    if (decryptedToken && decryptedId) {
      return next();
    }
  }

  if (from.path !== '/auth/login') {
    console.log(to.fullPath);
    router.push({ name: 'login', query: { redirect: to.fullPath } });
  } else {
    next({ name: 'login' });
  }
});


router.afterEach((to) => {
  if (to.name === 'login' && to.query.redirect) {
    const redirectTo = to.query.redirect as string;
    if (redirectTo) {

      router.push(redirectTo);
    } else {

      router.push({ name: 'dashboard.home' });
    }
  }
});

export default router;
