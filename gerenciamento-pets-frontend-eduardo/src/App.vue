<template>
  <v-layout>
    <!-- Colocando o menu no código -->
    <Menu />
    <v-main>
       <router-view></router-view>
    </v-main>
  </v-layout>
</template>

<!-- Importando o menu de navigação -->
<script>
 import Menu from './components/Menu.vue'

// Declarando o Menu para se transformar em uma tag
export default {
  components: {
    Menu
  }
}

</script>

