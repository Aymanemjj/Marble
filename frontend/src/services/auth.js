import axiosClient from "../axios";




export function signIn(res) {
  let token = res.token;
  let user = res.user;

  localStorage.setItem('user', JSON.stringify(user));
  localStorage.setItem('token', token);
  
}


export async function signOut() {
    localStorage.removeItem('user');
    localStorage.removeItem('token');
    await axiosClient.post('/logout')
    location.reload();
}


export async function authintify(data, path) {
    try {
        const res = await axiosClient.post(`/${path}`, data.value);
        signIn(res.data.data);
        router.push('/');
    } catch (err) {
        console.log(err.response.data)
    }
}