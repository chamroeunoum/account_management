import axios from "axios"

export default {
  async list(api,params){
    return await axios.get(api)
  },
  async read(api,params){
    return await axios.get(api)
  },
  async create(){
    return await axios.get(api)
  },
  async update(){
    return await axios.get(api)
  },
  async delete(){
    return await axios.get(api)
  },
}