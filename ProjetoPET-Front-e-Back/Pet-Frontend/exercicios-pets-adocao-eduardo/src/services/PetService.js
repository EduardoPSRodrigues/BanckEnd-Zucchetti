import axios from 'axios'

class PetService {

  async getAllPets(){
    const response = await axios.get("http://localhost:8000/api/pets/adocao")
    return response.data
  }

  async getOnePet(id) {
    const response = await axios.get(`http://127.0.0.1:8000/api/pets/${id}/adocao`)
    return response.data
  }

  async adoptPet(data){
    const response = await axios.post(`http://127.0.0.1:8000/api/pets/adocao`, data)
    return response.data
  }

}

export default new PetService