import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import PostsView from '../views/Posts/View.vue'
import PostsCreate from '../views/Posts/Create.vue'
import PostsEdit from '../views/Posts/Edit.vue'
import PostsDetail from '../views/Posts/Detail.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/',
      name: 'posts',
      component: PostsView
    },
    {
      path: '/posts/create',
      name: 'postsCreate',
      component: PostsCreate
    },
    {
      path:'/posts/:id/edit',
      name: 'postsEdit',
      component: PostsEdit
    },
    {
      path:'/posts/:slug',
      name: 'postsDetail',
      component: PostsDetail
    },
  ]
})

export default router
