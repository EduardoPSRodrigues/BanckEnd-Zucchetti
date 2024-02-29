<template>
  <Menu />
  <div v-if="pet" class="container">
    <div class="title text-orange-darken-1 text-h5">
      <h1> {{ pet.titulo }}</h1>
    </div>
    <v-divider></v-divider>
    <div class="main-container">

      <v-img
          cover
          height="250"
          width="300"
          :src="pet.imagem"
        ></v-img>

      <div class="information-container">

        <div class="title  text-h5">
        <h2> {{ pet.descricao }} </h2>
      </div>

        <p> {{ pet.texto_completo }} </p>
        <v-row justify="center">

        </v-row>
      </div>
    </div>
  </div>
</template>

<script>
  import Menu from '../pessoa2/Menu.vue'
  import axios from 'axios'

  export default {
    data: () => ({
      pet: null,
    }),

    mounted() {
      const id = this.$route.params.id
      axios.get(`http://127.0.0.1:8000/api/listnews/${id}`).then((response) => {
        this.pet = response.data
      })
    },
    components: {
      Menu
    },
    methods: {
    }
  }
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Noto+Sans:wght@400;700&family=Poppins&family=Quicksand:wght@300&family=Qwitcher+Grypen:wght@700&family=Rubik&family=Secular+One&display=swap');

.container {
  margin: 0;
  padding: 0;
  border: 0;
  box-sizing: border-box;

  font-family: 'Poppins', Arial, Helvetica, sans-serif;
}

.title {
  margin-top: 100px;
  margin-left: 110px;
  margin-bottom: 20px;
}

.main-container {
  height: 100vh;
  width: 100%;

  display: flex;
  align-items: center;
  justify-content: center;

  margin-left: 100px;
  margin-top: -120px;
}

.information-container {
  width: 100%;
  display: flex;
  flex-direction: column;

  margin-left: 30px;
}

@media screen and (max-width: 600px) {

  .container {
    width: 100%;
    display: flex;
    flex-direction: column; 
  }
  .main-container {
    margin-top: -10px;
    flex-direction: column-reverse;
  }

  .information-container {
    margin-top: 16px;
  }
  .button-information {
    margin: 30px;
  }
  
  .title {
    font-size: 1.5rem; 
    margin-top: 100px;
  }
  .carousel-container {
    width: 100%;
  }
}

</style>