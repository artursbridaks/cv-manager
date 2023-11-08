import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomeView
  },
  {
    path: '/cv-create',
    name: 'newCv',
    component: () => import('../views/NewCvView.vue')
  },
  {
    path: '/users-data/:id/edit',
    name: 'editCv',
    component: () => import('../views/EditCvView.vue')
  },
  {
    path: '/users-data/:id',
    name: 'viewCv',
    component: () => import('../views/ViewCvView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
