import { createRouter, createWebHistory } from 'vue-router'

import Main from '../views/Main.vue'
import Home1 from '../views/pessoa1/Home.vue'
import Home2 from '../views/pessoa2/Home.vue'
import Home3 from '../views/pessoa3/Home.vue'
import Home4 from '../views/pessoa4/Home.vue'
import Pets2 from '../views/pessoa2/Pets.vue'
import PetsProfilePessoa2 from '../views/pessoa2/Profile.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'main',
      component: Main
    },
    {
      path: '/home1',
      name: 'home1',
      component: Home1
    },
    {
      path: '/adocoes-de-animais',
      name: 'home2',
      component: Home2
    },
    {
      path: '/home3',
      name: 'home3',
      component: Home3
    },
    {
      path: '/home4',
      name: 'home4',
      component: Home4
    },
    {
      path: '/lista-de-adocoes',
      name: 'pets2',
      component: Pets2
    },
    {
      path: '/pets-adocao/:id/perfil',
      name: 'PetsProfilePessoa2',
      component: PetsProfilePessoa2
    },
   
  ]
})

export default router
