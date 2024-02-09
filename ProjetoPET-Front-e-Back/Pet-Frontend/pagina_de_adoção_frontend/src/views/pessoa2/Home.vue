<template>
  <Menu />
  <div class="container">
    <div id="inicio" class="start-container">
      <div class="text-main mx-16">
        <h1 class="mb-6 text-orange-darken-1">Um Convite para o Amor Incondicional: Adote um Companheiro Peludo</h1>
        <p class="text-justify text-h6 mb-3">
          Em um mundo repleto de histórias de desafios, tristezas e superações, há uma oportunidade única de transformar vidas e acalentar corações. Convidamos você a abrir as portas do seu lar e do seu coração para uma jornada de amor incondicional - <strong>a adoção de um fiel amigo peludo.</strong>
        </p>
        <p class="text-justify text-h6">
          Ao escolher adotar, você não apenas oferece um lar, mas proporciona uma segunda chance de felicidade. Esses seres encantadores têm o poder mágico de transformar uma casa em um lar vibrante, repleto de risos, brincadeiras e momentos tocantes.
        </p>
      </div>
      <v-carousel 
        class="start-carousel"
        cycle
        height="400"
        hide-delimiter-background
        delimiter-icon="mdi-paw"
        :show-arrows="false"
      >
        <v-carousel-item
          v-for="(image,photo) in images"
          :key="photo"
          :src="image.src"
          :width="700"
          cover
          rounded="xl" 
        >
        </v-carousel-item>
      </v-carousel>
    </div>
    <div id="sobre-nos" class="aboutUs-container">
      <img src="https://vale.com/documents/d/guest/grupo-398-2x-png" class="my-15" />
      <div class="w-50 aboutUs-text">
        <h1 class="mb-6 ml-16 pl-16">Sobre Nós</h1>
        <p class="text-justify text-h6 mb-3 ml-16 pl-16">
          O PetsRescue é o programa de adoção responsável criado com o objetivo encontrar novas famílias para os animais que foram abandonados.
        </p>
        <p class="text-justify text-h6 ml-16 pl-16">
          Enquanto esperam pela adoção, os animais são cuidados com muito amor e carinho pelo nosso time de especialistas nas instalações do abrigo.
        </p>
      </div>
    </div>

    <div id="conheca-os-bichinhos" class="meetAnimals-container">
      <div class="w-50">
        <h1 class="mb-6">Conheça os bichinhos</h1>
        <p class="text-justify text-h6 mb-3 pr-10">
          Nossos espaços abrigam uma diversidade encantadora de animais: dos menores aos maiores, dos mais jovens aos mais experientes, dos mais tranquilos aos mais brincalhões.
        </p>
        <p class="text-justify text-h6 mb-3 pr-10">
          Não seja tímido! Clique no botão abaixo para conhecer nossos bichinhos e o seu perfil de cada bichinho. Ah! Não esqueça de escolher um para levar pra casa.
        </p>
        <p class="text-justify text-h6 font-weight-bold pr-10">
          Encontre o seu próximo melhor amigo.
        </p>
        <div class="button-meetAnimals">
          <router-link to="lista-de-adocoes">
            <v-btn 
              class="text-h5 text-orange-darken-1 text-uppercase font-weight-bold mt-8" 
              color="brown-darken-3" 
              rounded="xl" 
              size="x-large" 
              :width="400" 
              :height="60"
            >
              Quero adotar
            </v-btn>
          </router-link>
        </div>
      </div>
      <div class="image-meetAnimals">
        <img src="https://vale.com/documents/d/guest/dog-blue" class="pa-10" />
        <img src="https://vale.com/documents/d/guest/dog-esmeralda" />
      </div>
    </div>

    <div id="como-adotar" class="w-100 adoption-container">
      <h1 class="mx-16 my-6">Sim, eu quero levar um pra casa</h1>
      <p class="text-justify text-h6 mx-16">
         Quer fazer parte dessa corrente do bem e adotar? Entenda como funciona:
      </p>
      <div class="d-flex">
        <div class="image-adoption w-50 d-flex flex-column">
          <img src="../pessoa2/images/Cachorro05.jpg" width="600" class="pa-8"/>
        </div>
        <div>
          <v-container>
            <v-row>
              <v-card-text>
                <div class="text-h6 ms-1 mb-2">
                  Se liga no passo a passo:
                </div>
                  <v-timeline density="compact" align="start">
                    <v-timeline-item
                      v-for="step in steps"
                      :key="step"
                      :dot-color="step.color"
                      size="x-small"
                    >
                      <div class="mb-4">
                        <div class="text-h6 font-weight-bold">{{ step.from }}</div>
                        <div class="text-h6">{{ step.step }}</div>
                      </div>
                    </v-timeline-item>
                  </v-timeline>
              </v-card-text>
            </v-row>
          </v-container>
        </div>
      </div>
    </div>
    <div class="information-container pa-15">
      <div>
        <p class="text-h6 mb-2"><strong>Institucional</strong></p>
        <p>Inicio</p>
        <p>Quem Somos</p>
        <p>Conheça os bichinhos</p>
        <p>Adoção</p>
      </div>
      <div>
        <p class="text-h6 mb-2"><strong>Como ajudar?</strong></p>
        <p>Quero adotar</p>
        <p>Quero doar</p>
        <p>ONGs/Protetores</p>
      </div>
      <div>
        <p class="text-h6 mb-2"><strong>Contato</strong></p>
        <p>+55 (99)99999-9999</p>
        <p>petsrescue@gmail.com</p>
        <p>Brasil, Salvador - 40999-999</p>
        <v-btn
          class="ma-2"
          variant="text"
          icon="mdi-facebook"
        ></v-btn>
        <v-btn
          class="ma-2"
          variant="text"
          icon="mdi-linkedin"
        ></v-btn>
        <v-btn
          class="ma-2"
          variant="text"
          icon="mdi-instagram"
        ></v-btn>
      </div>
    </div>
  </div>
</template>

<script>
 import Menu from '../pessoa2/Menu.vue'
 import ImagemCarrossel01 from '../pessoa2/images/carousel/Cachorro01.png'
 import ImagemCarrossel02 from '../pessoa2/images/carousel/Cachorro02.jpg'
 import ImagemCarrossel03 from '../pessoa2/images/carousel/Gato01.jpg'
 import ImagemCarrossel04 from '../pessoa2/images/carousel/Gato02.jpg'
 
  export default {
    data () {
      return {
        images: [
          { src: ImagemCarrossel01},
          {src: ImagemCarrossel03},
          {src: ImagemCarrossel02},
          {src: ImagemCarrossel04,},
        ],
        steps: [
          {
            from: '1°:',
            step: `Preencha o Formulário de Interesse de Adoção Responsável disponível na página de adoção do animal que você deseja acolher.`,
            color: 'orange-darken-1',
          },
          {
            from: '2°:',
            step: 'Aguarde o retorno da nossa equipe, que acontece em até 7 dias. Estamos ansiosos para entrar em contato com você!',
            color: 'brown-darken-3',
          },
          {
            from: '3°:',
            step: 'Prepare-se para as entrevistas virtuais. Você vai receber todas as informações sobre o animal escolhido e o processo de adoção. Com tudo certo, é só aguardar para receber o seu novo melhor amigo em casa! ​',
            color: 'orange-darken-1',
          },
        ],
      }
    },
    components: {
      Menu
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

.start-container {
  height: 100vh;
  width: 100%;

  display: flex;
  align-items: center;
  justify-content: center;
}

.text-main {
  width: 90%;
}

.aboutUs-container {
  background-color: #5D4037;
  color: white;

  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.meetAnimals-container { 
  background-color: #EF6C00;
  color: white;
  
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.button-meetAnimals {
  display: flex;
  align-items: center;
  justify-content: center;
}

.information-container {
  background-color: #5D4037;
  color: white;

  width: 100%;
  display: flex;
  justify-content: space-around;
}

@media screen and (max-width: 600px) {
  .container {
    font-size: 14px;
  }
  .start-container {
    height: 200vh;
    flex-direction: column;
  }
  .start-carousel img {
    width: 100%; 
  }
  .aboutUs-container {
    width: 100%;
    flex-direction: column-reverse;
  }
  .meetAnimals-container {
    flex-direction: column;
  }
  .image-meetAnimals {
    width: 100%;
    display: flex;
    text-align: center;
  }
  .adoption-container {
    width: 100%;
  }

  .image-adoption img {
    display: none;
  }
}
</style>