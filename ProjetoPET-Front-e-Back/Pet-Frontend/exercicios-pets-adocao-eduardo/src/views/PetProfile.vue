<template>
  <div v-if="pet">
    <h1>Amigo: {{ pet.name }}</h1>
    <ul>
      <li>Raça: {{ pet.race.name }}</li>
      <li>Espécie: {{ pet.specie.name }}</li>
      <li>IDADE: {{ pet.age }} ANO(S)</li>
      <li>Peso: {{ pet.weight }} KG</li>
      <li>Porte: {{ pet.size }}</li>
    </ul>

    <form class="form" @submit.prevent="handleSubmit">
      <p>Poucos passos para adotar {{ pet.name }}</p>
      <div class="input-form">
        <label>Nome</label>
        <input v-model="name" data-test="input-name"/>
      </div>
       <div class="input-form">
        <label>CPF</label>
        <input v-model="cpf"/>
      </div>
      <div class="input-form">
        <label>Contato</label>
        <input v-model="contact" data-test="input-contact" />
      </div>
      <div class="input-form">
        <label>Email</label>
        <input v-model="email" type="email" data-test="input-email"/>
      </div>
      <div class="input-form">
        <label>Fale um pouco sobre a sua motivação de adotar esse pet:</label>
        <textarea v-model="observations" data-test="textarea-observations" />
      </div>
      <button type="submit" data-test="submit-button">Cadastrar</button>
    </form>
  </div>
</template>


<script>
import PetService from '@/services/PetService'

export default {
  data() {
    return {
      pet: null,
      name: '',
      email: '',
      contact: '',
      observations: '',
      cpf: ''
    }
  },
  methods: {
    handleSubmit() {
      PetService.adoptPet({
        name: this.name,
        email: this.email,
        contact: this.contact,
        observations: this.observations,
        pet_id:  this.$route.params.id,
        cpf: this.cpf
      })
        .then(() => {
          alert('Cadastrado com sucesso')
        })
        .catch(() => {
          alert('Erro ao tentar realizar a adocao')
        })
    }
  },
  mounted() {
    const id = this.$route.params.id
    PetService.getOnePet(id).then((data) => {
      this.pet = data
    })
  }
}
</script>

<style scoped>
.form {
  display: flex;
  flex-direction: column;
}

.form input {
  width: 30%;
  height: 32px;
}

.input-form {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
</style>