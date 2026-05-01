import { computed, onMounted, ref } from "vue"
import axiosClient from "../axios"
import router from "../router"
import { useRoute } from "vue-router"

export function usePieceEdit() {
    const route = useRoute()
    const errors = ref({})
    const PIECE = ref(null);
    const isLoading = computed(() => PIECE.value == null);
    const data = ref({
        title: '',
        story: '',
        date: '',
        tags: []
    })

    onMounted(async () => {
        try {
            PIECE.value = (await axiosClient.get(`/piece/${route.params.id}`)).data.data.piece;


            data.value.title = PIECE.value.title
            data.value.story = PIECE.value.story
            data.value.date = PIECE.value.date
            data.value.tags = PIECE.value.tags.map(t=> t.id)


        } catch (err) {
            console.log(err);
        }

    });

    const submit = async () => {
        try {
            const res = await axiosClient.put(`/piece/${route.params.id}/update`, data.value)
            console.log(res);

            router.push(`/piece/${res.data.data.piece.id}`)
        } catch (err) {
            return errors.value = err;

        }
        
    }

    return {
        data,
        errors,
        submit,
        PIECE,
        isLoading
    }
}