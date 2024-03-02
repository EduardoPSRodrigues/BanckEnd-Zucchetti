import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import PetsList from '../views/PetsList.vue'
import PetsProfile from '../views/PetProfile.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/pets-adocao',
      name: 'PetsList',
      component: PetsList
    },
    {
      path: '/pets-adocao/:id/perfil',
      name: 'PetsProfile',
      component: PetsProfile
    },
  ]
})

export default router
