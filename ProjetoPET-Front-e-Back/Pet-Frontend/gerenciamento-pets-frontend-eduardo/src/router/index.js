import { createRouter, createWebHistory } from 'vue-router'

import Home from '../views/Home.vue'
import ListPets from '../views/ListPets.vue'
import FormPet from '../views/FormPet.vue'
import Login from '../views/Login.vue'
import ListProfissionals from '../views/ListProfissionals.vue'
import AprendizadoVue from '@/views/Aprendizado.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
      path: '/pets/:id',
      name: 'ListPets',
      component: ListPets
    },
    {
      path: '/pets/novo',
      name: 'FormPet',
      component: FormPet
    },
    {
      path: '/veterinarios',
      name: 'ListProfissionals',
      component: ListProfissionals
    },
    {
      path: '/aprendizado',
      name: 'Aprendizado',
      component: AprendizadoVue
    }
  ]
})

export default router
