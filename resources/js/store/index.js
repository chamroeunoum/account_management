import { createStore, createLogger } from 'vuex'
// import product from './modules/product'
import auth from './modules/authentication'
import user from './modules/user'
import regulator from './modules/regulator/regulator'
import regulatorType from './modules/regulator/type'
// import client from './modules/client'
// import staff from './modules/staff'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  state: {
    // apiServer: 'http://sctservice.kabit.asia/api'
    // apiServer: 'http://127.0.0.1:8000/api'
    apiServer: 'http://127.0.0.1:8000/api' ,
    // branch: ''
  },
  modules: {
    // product ,
    auth,
    user,
    /**
     * Regulator Section
     */
    regulator,
    "regulatorType" : regulatorType
    // client,
    // staff
  },
  strict: debug,
  plugins: debug ? 
    [
      createLogger()
    ] : 
    [
      
    ]
})