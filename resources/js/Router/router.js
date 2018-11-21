import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import Signup from '../components/login/Signup'
import Logout from '../components/login/Logout'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/Read'
import Ask from '../components/forum/Ask'

const routes = [
    { path: '/login', component: Login },
    { path: '/signup', component: Signup },
    { path: '/forum', component: Forum, name:"forum"},
    { path: '/question/:slug', component: Read, name:"read", props: true},
    { path: '/logout', component: Logout, name:"logout"},
    { path: '/ask', component: Ask, name:"ask"},
  ]

  const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: 'history'
  })

export default router;