<template>
  <Menu />
  <div class="container">
    <h1 class="title">Bichinhos para adoção</h1>
    <div>
      <v-form class="form-container ma-4">
        <v-text-field
          label="Nome"
          placeholder="Digite o nome do animal"
          type="text"
          v-model="name"
          variant="outlined" 
          rounded="xl"
          prepend-inner-icon="mdi-magnify"
        ></v-text-field>
        <v-text-field
          label="Idade"
          type="text"
          v-model="age"
          variant="outlined" 
          rounded="xl"
        ></v-text-field>
        <v-select
          label="Espécie" 
          placeholder="Todas as espécies"
          type="text"
          v-model="species"
          variant="outlined"
          rounded="xl"
          item-title="specie"
          :items="itemSpecies" 
        />
        <v-select
          label="Gênero" 
          placeholder="Todos os gêneros"
          type="text"
          v-model="gender"
          variant="outlined"
          rounded="xl"
          item-title="gender"
          :items="itemGenders" 
        />
        <v-select
          label="Tamanho" 
          placeholder="Todas os tamanhos"
          type="text"
          v-model="size"
          variant="outlined"
          rounded="xl"
          item-title="size"
          :items="itemSize" 
        />
      </v-form>
    </div>
    <div class="card-container">
      <v-card
        v-for="pet in filteredPets" 
        :key="pet.id" 
        rounded="xl" 
        class="ma-6"
        @mouseover="handleMouseOver"
        @mouseout="handleMouseOut"
        @click="redirectToProfile(pet.id)"
        :class="{ 'card-hover': isHovered }"
      >
        <v-img
          cover
          height="250"
          width="300"
          :src="pet.photo"
        ></v-img>
        <v-card-title class="d-flex">
          <h4 class="font-weight-black mt-1">{{ pet.name }}</h4>
          <v-icon :class="{ 'text-pink-lighten-1': pet.gender === 'Female', 'text-blue-lighten-1': pet.gender === 'Male' }">
          {{ pet.gender === 'Female' ? icon="mdi-gender-female" : icon="mdi-gender-male" }}
          </v-icon>
        </v-card-title>
        <v-card-text >
          <p class="card-text">
            {{ pet.age }} {{ pet.age === 1 ? 'ano' : 'anos' }} | Porte {{ this.translateSize(pet.size) }}
          </p>
        </v-card-text>
        <div class="d-flex justify-center text-decoration-none">
          <v-btn 
            class="text-brown-darken-3 font-weight-black text-capitalize mt-2 mb-6"
            variant="flat" 
            color="orange-darken-1" 
            rounded="xl" 
            size="x-large"
            :width="200" 
          >
            Saiba mais
          </v-btn>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script>
  import Menu from '../pessoa2/Menu.vue'
  import axios from 'axios'
  
 export default {
  data() {
    return {
      pets: [],
      isHovered: false,
      name: '',
      age: '',
      species: '',
      gender: '',
      size: '',

      itemSpecies: [
        {specie: 'Cachorro', value: 'Dog'},
        {specie: 'Gato', value: 'Cat'},
      ],
      itemGenders: [
        {gender: 'Fêmea', value: 'Female'},
        {gender: 'Macho', value: 'Male'},
      ],
      itemSize: [
        {size: 'Pequeno', value: 'Small'},
        {size: 'Médio', value: 'Medium'},
        {size: 'Grande', value: 'Large'},
        {size: 'Gigante', value: 'Extra_Large'},
      ],
    }
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/pets/adocao')
      .then((response) => {
        
        this.pets = response.data
      })
      .catch(() => {
        alert('Desculpe, não foi possivel carregar os produtos! Por favor, tente novamente')
      })
  },
  components: {
    Menu
  },
  computed: {
    filteredPets() {
      return this.pets.filter(pet => {
        const nameMatch = this.name.trim().toLowerCase() === '' || pet.name.toLowerCase().includes(this.name.trim().toLowerCase());
        const ageMatch = this.age === '' || pet.age.toString() === this.age;
        const specieMatch = this.species === '' || pet.species === this.species;
        const genderMatch = this.gender === '' || pet.gender === this.gender;
        const sizeMatch = this.size === '' || pet.size === this.size;
        return nameMatch && ageMatch && specieMatch && genderMatch && sizeMatch;;
      });
    }
  },
  methods: {
    translateSize(name) {
      const lowerCaseName = name.toLowerCase();

       switch(lowerCaseName) {
        case 'small': {
          return 'Pequeno'
        }
        case 'medium': {
          return 'Médio'
        }
        case 'large' : {
          return 'Grande'
        }
         case 'extra_large' : {
          return 'Gigante'
        }
        default: {
          return name
        }
       }
    },
    handleMouseOver() {
      this.isHovered = true;
    },
    handleMouseOut() {
      this.isHovered = false;
    },
    redirectToProfile(petId){
        this.$router.push(`/pets-adocao/${petId}/perfil`)
    }
  },
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
  margin-left: 28px;
}

.form-container {
  display: flex;
}

.card-container {
  height: 100vh;
  width: 100%;

  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  margin-top: -24px;
}

.card-text {
  font-size: 18px;
}

.card-hover {
  transition: transform 0.3s ease-in-out;
}

.card-hover:hover {
  transform: translate(0, -10px);
}

@media screen and (max-width: 600px) {
  .form-container {
    max-width: 100%;
    display: flex;
    flex-direction: column;
  }

  .card-container {
    grid-template-columns: 1fr;
  }
}
</style>