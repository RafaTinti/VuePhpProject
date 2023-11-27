import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CustomerView from '../views/Customers/Index.vue'
import CustomerCreate from '../views/Customers/Create.vue'
import CustomerEdit from '../views/Customers/Edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/customers',
      name: 'customers',
      component: CustomerView
    },
    {
      path: '/customers/create',
      name: 'customersCreate',
      component: CustomerCreate
    },
    {
      path: '/customers/:id/edit',
      name: 'customersEdit',
      component: CustomerEdit
    },
  ]
})

export default router
