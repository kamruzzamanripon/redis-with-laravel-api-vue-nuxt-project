import Layout from '@/views/Layout.vue'
import Login from '@/views/Login.vue'
import ProductsBackend from '@/views/ProductsBackend.vue'
import ProductsFrontend from '@/views/ProductsFrontend.vue'
import Profile from '@/views/Profile.vue'
import Rankings from '@/views/Rankings.vue'
import Register from '@/views/Register.vue'
import Stats from '@/views/Stats.vue'
import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path:'/login', component:Login},
    {path:'/register', component:Register},
    {
      path:'', 
      component: Layout,
      children:[
        {path: '', component: ProductsFrontend},
        {path: '/backend', component: ProductsBackend},
        {path: '/profile', component: Profile},
        {path: '/stats', component: Stats},
        {path: '/rankings', component: Rankings},
      ]
    }
  ]
})

export default router
