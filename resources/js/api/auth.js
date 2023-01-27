import axios from "axios"
import { getAuthorization } from "../plugins/authentication"
export default {
  async login(url,params){
    return await axios({
      method: 'post' ,
      url: url ,
      data: params
    })
  },
  async logout(url){
    return await axios({
      method: 'post' ,
      url: url ,
      headers: {
        'Authorization' : getAuthorization()
      }
    })
  },
  async readProfile(url){
    return await axios({
      method: 'get' ,
      url: url ,
      data: params ,
      headers: {
        'Authorization' : getAuthorization()
      }
    })
  },
  async updateProfile(url){
    return await axios({
      method: 'post' ,
      url: url ,
      data: params ,
      headers: {
        'Authorization' : getAuthorization()
      }
    })
  },
  
  async uploadProfilePicture(url,params){
    return await axios({
      method: 'post' ,
      url: url ,
      data: params ,
      headers: {
        'Authorization' : getAuthorization()
      }
    })
  },
  async changePassword(url,params){
    return await axios({
      method: 'post' ,
      url: url ,
      data: params ,
      headers: {
        'Authorization' : getAuthorization()
      }
    })
  }
}