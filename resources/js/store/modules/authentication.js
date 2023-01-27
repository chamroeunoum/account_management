import auth from '../../api/auth'
import './../../plugins/authentication'
import { setToken, setUser } from './../../plugins/authentication'

// initial state
const state = () => ({
  user: null ,
  token: {
    access_token: null ,
    expires_at: new Date() ,
    token_type: "Bearer"
  }
})

// getters
const getters = {
  getAuthorization( state , getters, rootState ){
    return state.token.token_type + " " + state.token.access_token 
  },
  checkAuth(state, getters, rootState ){
    return state.token.access_token !== "" && ( new Date(state.token.expires_at) >= new Date() )
  }
}

// actions
const actions = {
  /**
   * Login
   */
   async login({state, commit, rootState }, params ){
    return await auth.login(rootState.apiServer+"/authentication/login", params) 
   },
  
  /**
   * Logout
   */
  async logout({state , commit, rootState},params){
    /**
     * Logout user
     */
    return await auth.logout(rootState.apiServer+"/authentication/logout",params)
  },
  /**
   * Get profile
   */
  /**
   * Update profile
   */
  /**
   * Update profile picture
   */
  
}

// mutations
const mutations = {
  setAuthentication (state, { user, token }) {
    state.user = user
    state.token = token
    setToken(token)
    setUser(user)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}