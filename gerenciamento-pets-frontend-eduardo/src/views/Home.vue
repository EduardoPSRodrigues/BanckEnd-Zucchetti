<template>
  <h1 class="title">Espécies cadastradas</h1>
  <div class="list-species">
    <v-card
      v-for="specie in species"
      :key="specie.id"
      width="30%"
      :title="specie.name"
      link
      @click="handleRedirect(specie.id)"
    />
  </div>
</template>

<script>
//Importando o serviço
import SpecieService from '../services/SpecieService'

export default {
  data() {
    return {
      species: []
    }
  },
  methods: {
    handleRedirect(id) {
        this.$router.push(`/pets/${id}`);
    }
  },
  //Executado assim que a tela é montada
  mounted() {
    //Chamando a classe do serviço e o método que desejo executar
    SpecieService.getAllSpecies()
      .then((data) => {
        this.species = data
      })
      .catch((error) => {
        alert('Houve um erro. O servidor backend esta fora do ar.')
      })
      .finally(() => {
        // Usando normalmente para pausar o loading
      })
  }
}
</script>

<style scoped>
.title {
  margin-top: 20px;
  margin-left: 20px;
}
.list-species {
  display: flex;
  gap: 10px;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 20px;
}
.item {
  width: 30%;
}
</style>
