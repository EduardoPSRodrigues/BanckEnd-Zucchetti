<template>
  <v-layout>
    <!-- Ocultar o menu da tela de login -->
    <Menu v-if="this.$route.path !== '/'" />
    <v-main>
       <router-view></router-view>
    </v-main>
  </v-layout>
</template>

<script>
 import Menu from './components/Menu.vue'

export default {
  components: {
    Menu
  }
}

</script>