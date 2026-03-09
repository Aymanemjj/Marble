



export function signIn(User) {
  let token = User.token
  delete User.token
  
  localStorage.setItem('user', JSON.stringify(User))
  localStorage.setItem('token', token)
}


export function signOut() {
    localStorage.removeItem('user');
    localStorage.removeItem('token');
}