export const authLogout = () => {
  try {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
  } catch (error) {
    console.log(error)
  }
}
export const isAuth = () => {
  try {
    if( localStorage.getItem('token') === null ){
      return false
    }
    return true
  } catch (error) {
    console.log(error)
  }
}
export const getToken = () => {
  try {
    return JSON.parse( localStorage.getItem('token') )
  } catch (error) {
    console.log(error)
  }
}
export const getAuthorization = () => {
  try {
    return getToken().token_type + ' ' + getToken().access_token
  } catch (error) {
    console.log(error)
  }
}
export const getAccessToken = () => {
  try {
    return getToken().access_token
  } catch (error) {
    console.log(error)
  }
}
export const getAccessTokenType = () => {
  try {
    return getToken().token_type
  } catch (error) {
    console.log(error)
  }
}
export const getExpiresAt = () => {
  try {
    return getToken().expires_at
  } catch (error) {
    console.log(error)
  }
}
export const setToken = (token) => {
  localStorage.setItem('token', JSON.stringify( token ));
}

export const getUser = () => {
  try {
    return JSON.parse(localStorage.getItem('user'))
  } catch (error) {
    console.log(error)
  }
}
export const setUser = (user) => {
  localStorage.setItem('user',JSON.stringify(user));
}
export const isAdmin = () => {
  let admin = getUser()
  if( isAuth() && admin !== null && admin.role == 1 ){
    return true 
  }
  return false
}
