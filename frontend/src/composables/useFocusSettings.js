import { ref } from "vue";
import { useAxiosRequest } from "./useAxiosRequest";
import { useFocusStore } from "../stores/useFocusStore";
import { initializeFocus } from "../services/FocusService";
import router from "../router";

export function useFocusSettings() {

    const data = ref({
        minutes: 1,
        seconds: 0,
        tags: []
    })

    const errors = ref({
        noPieces: false,
        noMorePieces: false
    })

    async function submit() {
        await initializeFocus(data.value)

        router.push('/focus/piece')
    }

    return { data, submit, errors }
}