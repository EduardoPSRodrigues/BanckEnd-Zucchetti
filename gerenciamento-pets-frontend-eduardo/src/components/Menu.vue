<template>
  <v-navigation-drawer :rail="rail" permanent>
    <v-list>
      <v-list-item
        prepend-avatar="https://pics.craiyon.com/2023-10-10/eaccdd9dc1694523a22130b15534cad6.webp"
        title="Eduardo Phelipe"
        subtitle="eduardo@gmail.com"
      ></v-list-item>
    </v-list>

    <!-- Linha para separar os dados do usuário -->
    <v-divider></v-divider>

    <v-list density="compact" nav>
      <router-link to="/">
        <v-list-item prepend-icon="mdi-folder" title="Home" value="myfiles"> </v-list-item>
      </router-link>

      <router-link to="/pets/novo">
        <v-list-item prepend-icon="mdi-star" title="Novo pet" value="starred"> </v-list-item>
      </router-link>
    </v-list>
  </v-navigation-drawer>
</template>

