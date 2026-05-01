import axiosClient from "../axios";
import router from "../router";
import { useAuthStore } from "../stores/useAuthStore";



export function signIn(res) {
    let token = res.token;
    let user = res.user;

    const auth = useAuthStore();
    auth.register(user);
    localStorage.setItem('token', token);

}


export async function signOut() {
    const auth = useAuthStore();
    try {
        await axiosClient.post('/logout');
    } finally {
        auth.logout();
        router.push('/login');
    }
}


export async function authintify(data, path) {
    try {
        const res = await axiosClient.post(`/${path}`, data);
        signIn(res.data.data);
        router.push('/');
    } catch (err) {
        if (err.response?.status === 422) {
            return err.response.data.error;
        }
        console.log(err);
    }
}