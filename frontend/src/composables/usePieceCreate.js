import { onMounted, ref } from "vue"
import axiosClient from "../axios"
import router from "../router"
import { useAxiosRequest } from "./useAxiosRequest"
import { useAuthStore } from "../stores/useAuthStore"

export function usePieceCreate() {
    const auth = useAuthStore()
    auth.initialize()
    const errors = ref({})
    const data = ref({
        title: '',
        story: '',
        date: '',
        path: '',
        tags: [],
        artist: null
    })

    const artists = ref([])

    const submit = async () => {
        const formData = new FormData()
        formData.append('title', data.value.title)
        formData.append('story', data.value.story)
        formData.append('date', data.value.date)
        formData.append('path', data.value.path)
        formData.append('artist', data.value.artist)

        data.value.tags.forEach(tag => formData.append('tags[]', tag))

        try {
            const res = await axiosClient.post('/piece/create', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
            console.log(res);

            router.push(`/piece/${res.data.data.piece.id}`)
        } catch (err) {
            return errors.value = err.response.data.error;

        }
    }
    onMounted(async () => {
        if (auth.isAdmin) {
            artists.value = (await useAxiosRequest('get', '/artists', false)).data.artists

        }
    })
    return {
        data,
        errors,
        submit,
        artists,
        auth
    }
}