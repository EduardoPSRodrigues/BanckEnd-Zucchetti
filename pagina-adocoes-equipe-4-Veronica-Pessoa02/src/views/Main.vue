<template>
  <div>
    <div class="adocao-home">
      <h1>Adote pet 1 </h1>
      <button @click="entrar1">Ver Animais</button>
      <p>Criado por: Henrique</p>
    </div>
    <hr />

    <div class="adocao-home">
      <h1>PetsRescue </h1>
      <button @click="entrar2">Ver Animais</button>
      <p>Criado por: Verônica Vilas</p>
    </div>
    <hr />
    <div class="adocao-home">
      <h1>Adote pet 3</h1>
      <button @click="entrar3">Ver Animais</button>
      <p>Criado por: Henrique 3</p>
    </div>
    <hr />
    <div class="adocao-home">
      <h1>Adote pet 4 </h1>
      <button @click="entrar4">Ver Animais 4</button>
      <p>Criado por: Henrique4</p>
    </div>
    <hr />
  </div>
</template>

<script>
export default {
  methods: {
    entrar1() {
      this.$router.push('home1')
    },
    entrar2() {
      this.$router.push('adocoes-de-animais')
    },
    entrar3() {
      this.$router.push('home3')
    },
    entrar4() {
      this.$router.push('home4')
    }
  }
}
</script>

<style scoped>
.adocao-home {
  text-align: center;
  margin: 50px;
}

h1 {
  color: #2c3e50;
}

button {
  background-color: #3498db;
  color: #fff;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  border: none;
  border-radius: 5px;
}

button:hover {
  background-color: #2980b9;
}
</style>
