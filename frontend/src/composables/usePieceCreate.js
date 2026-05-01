import { ref } from "vue"
import axiosClient from "../axios"
import router from "../router"

export function usePieceCreate() {
    const errors = ref({})
    const data = ref({
        title: '',
        story: '',
        date: '',
        path: '',
        tags: []
    })

    const submit = async () => {
        const formData = new FormData()
        formData.append('title', data.value.title)
        formData.append('story', data.value.story)
        formData.append('date', data.value.date)
        formData.append('path', data.value.path)
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

    return {
        data,
        errors,
        submit
    }
}