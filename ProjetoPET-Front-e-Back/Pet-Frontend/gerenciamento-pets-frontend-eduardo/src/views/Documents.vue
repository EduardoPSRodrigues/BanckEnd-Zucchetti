<template>
  <v-app>
    <v-container>
      <v-card>
        <v-card-title>Envio de Documentos</v-card-title>
        <v-card-text>
          <v-form @submit.prevent="submitDocuments">
            <v-row>
              <v-col cols="12">
                <!-- accept é o tipo de documento que vai aceitar 
                esse componente v-file-input se for configurado ele pega varios arquivos, entao ele devolve
              um array e para pegar o primeiro arquivo pega na posição zero [0]-->
                <v-file-input
                  v-model="selectedFile1"
                  label="Selecione o cpf"
                  placeholder="Escolha um arquivo..."
                  prepend-icon="mdi-file"
                  accept=".pdf,.doc,.docx" 
                ></v-file-input>
              </v-col>
              <v-col cols="12">
                <v-file-input
                  v-model="selectedFile2"
                  label="Selecione o rg"
                  placeholder="Escolha um arquivo..."
                  prepend-icon="mdi-file"
                  accept=".pdf,.doc,.docx"
                ></v-file-input>
              </v-col>
              <v-col cols="12">
                <v-file-input
                  v-model="selectedFile3"
                  label="Selecione o comprovante de residencia"
                  placeholder="Escolha um arquivo..."
                  prepend-icon="mdi-file"
                  accept=".pdf,.doc,.docx"
                ></v-file-input>
              </v-col>
              <v-col cols="12">
                <v-file-input
                  v-model="selectedFile4"
                  label="Selecione o termo de adocao"
                  placeholder="Escolha um arquivo..."
                  prepend-icon="mdi-file"
                  accept=".pdf,.doc,.docx"
                ></v-file-input>
              </v-col>
            </v-row>
            <v-btn type="submit" color="primary">Enviar Documentos</v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-container>
  </v-app>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      selectedFile1: null,
      selectedFile2: null,
      selectedFile3: null,
      selectedFile4: null
    }
  },
  methods: {
    async handleUploadFile(description, file, key) {
      try {
        /*Realizando um MultiForm Data no código */
        const formData = new FormData()

        //append é inserir
        formData.append('description', description)
        formData.append('file', file)
        formData.append('id', this.$route.params.id) //id esta na url
        formData.append('key', key) //o tipo de documento

        //Precisa dizer para o backend que nao vai chegar json e sim multiform data
        await axios.post('http://localhost:8000/api/upload', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
      } catch (error) {
        console.error('Erro ao enviar documentos:', error)
      }
    },
    async submitDocuments() {
      this.handleUploadFile('Cpf do cliente', this.selectedFile1[0], 'cpf') //o nome da key tem que ser o mesmo nome da coluna la na tabela solicitations_documents
      this.handleUploadFile('RG do cliente', this.selectedFile2[0], 'rg')
      this.handleUploadFile('Comprovante de residencia', this.selectedFile3[0], 'document_address')
      this.handleUploadFile('Termo de adoação', this.selectedFile4[0], 'term_adoption')
    }
  }
}
</script>