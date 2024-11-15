// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'

import Aboutme from '../components/Aboutme.vue';
import Contact from '../components/Contact.vue' ;

const routes = [
  { path: '/', redirect: "/about" },        
  { path: '/about', component: Aboutme },
  { path: "/contact", component: Contact}
]

const router = createRouter({
  history: createWebHistory(), 
  routes, 
})

export default router
