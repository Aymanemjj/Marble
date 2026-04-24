import axios from 'axios';
import router from "./router.js";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: false,
    withXSRFToken: false,

})

axiosClient.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config 
})


axiosClient.interceptors.response.use((response) => {
    return response;
}, error => {
    if (error.response && error.response.status === 401) {
        router.push({ name: 'Login' });
    }
    throw error;

})

export default axiosClient;