
<template>
  <div class="main-content">
    <div class="left-content">
      <h1 class="title">Me leva para casa</h1>
      <p class="text-description">Nós cuidamos deles. Agora deixe que eles cuidem de você.</p>
      <p class="text-description">
        Aqui a gente cuida de animais resgatados de áreas evacuadas de Minas Gerais e queremos
        compartilhar todo esse amor com mais pessoas por meio da adoção.
      </p>
      <p class="text-description">
        Ter um animal de estimação traz benefícios para a saúde física e mental. É uma troca de amor
        e carinho que faz bem pra todo mundo. Leve um para casa: cuide dele e deixe que ele cuide de
        você também.
      </p>
      <router-link to="pets-adocao">
        <button class="button-action">ADOTAR AGORA</button>
      </router-link>
    </div>
    <div class="right-content">
      <img src="https://vale.com/documents/d/guest/imagem-dogs01" class="main-image" />
    </div>
  </div>
</template>


<style scoped>
.title {
  font-size: 64px;
  color: rgb(225, 73, 18);
}

.text-description {
  font-size: 32px;
  text-align: justify;
}

.main-content {
  display: flex;
  width: 70%;
  margin: 0 auto;
  align-items: center;
}

.main-image {
  width: 400px;
  object-fit: contain;
}

.button-action {
    width: 300px;
    height: 64px;
    background: rgb(225, 73, 18);
    border-radius: 4px;
    color: #fff;
    font-size: 20px;
}

@media (max-width: 1000px) {
  .main-content {
    flex-direction: column-reverse;
  }

  .text-description {
    font-size: 20px;
  }
}
</style>