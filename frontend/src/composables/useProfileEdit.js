import { computed, onMounted, ref } from "vue"
import { useAuthStore } from "../stores/useAuthStore"
import { useAxiosRequest } from "./useAxiosRequest"

export function useProfileEdit() {
    const AUTH = useAuthStore()
    const data = ref({
        biography: AUTH.auth.profile.biography ?? '',
        fav_piece_id_1: AUTH.auth.profile.fav_piece_id_1 ?? null,
        fav_piece_id_2: AUTH.auth.profile.fav_piece_id_2 ?? null,
    })
    const pieces = ref(null);
    const isLoading = computed(() => pieces.value == null);
    const previews = ref({ picture: null, banner: null })
    const errors = ref({})

    onMounted(async()=>{
        pieces.value = (await useAxiosRequest('get', `/creator/user/${AUTH.auth.id}/gallery`,false)).data.pieces        
    })

    function onFile(field, event) {
        const file = event.target.files[0]
        if (!file) return
        data.value[field] = file
        previews.value[field] = URL.createObjectURL(file)
    }

    async function submit() {
        const form = new FormData()
        if (data.value.picture) form.append('picture', data.value.picture)
        if (data.value.banner) form.append('banner', data.value.banner)
        form.append('biography', data.value.biography)
        if (data.value.fav_piece_id_1) form.append('fav_piece_id_1', data.value.fav_piece_id_1)
        if (data.value.fav_piece_id_2) form.append('fav_piece_id_2', data.value.fav_piece_id_2)
        await useAxiosRequest('patch', '/profile/edit', form)
    }
    AUTH.initialize()
    return { data, previews, errors, onFile, submit, pieces, isLoading }
}