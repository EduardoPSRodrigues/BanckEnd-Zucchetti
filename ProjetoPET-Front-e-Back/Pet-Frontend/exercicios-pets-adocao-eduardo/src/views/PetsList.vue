<template>
  <div class="container">
    <h1>Adote um amigo !</h1>
    <div class="pet-list">

      <div class="pet-item" v-for="pet in pets" @click="redirectToProfile(pet.id)" data-test="item-pet">
        <img src="https://i.imgflip.com/5y7m17.png" />
        <span>{{ pet.pet_name }}</span>
      </div>

    </div>
  </div>
</template>

<script>
import PetService from '../services/PetService'

export default {
  data() {
    return {
      pets: []
    }
  },
  methods: {
    redirectToProfile(petId){
        this.$router.push(`/pets-adocao/${petId}/perfil`)
    }
  },
  mounted() {
   PetService.getAllPets()
      .then((data) => {
        this.pets = data
      })
      .catch(() => alert('Houve um erro. Entre em contato com a ONG'))
  }
}
</script>


<style scoped>
.container {
  width: 70%;
  margin: 0 auto;
}

.pet-list {
  display: flex;
  width: 100%;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  margin: 0 auto;
}

.pet-item {
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  padding-bottom: 10px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.pet-item:hover {
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.7);
}

.pet-item img {
  width: 250px;
  border-radius: 12px;
}

.pet-item span {
  font-size: 24px;
  font-weight: bold;
  margin: 10px 0;
  color: #ecb11f;
}
</style>