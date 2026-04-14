



export function signIn(res) {
  let token = res.token;
  let user = res.user;

  localStorage.setItem('user', JSON.stringify(user));
  localStorage.setItem('token', token);
  
}


export function signOut() {
    localStorage.removeItem('user');
    localStorage.removeItem('token');
    
    location.reload();
}