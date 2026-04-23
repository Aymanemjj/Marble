import { computed, onMounted, ref } from "vue";
import axiosClient from "../axios";

export function useFocusPiece() {
    const PIECES = ref(null);
    const ORDER = ref(0);
    const SELECTED = ref(null);
    const isLoading = computed(() => PIECES.value == null);

    const data = {
        tags: ['Watercolor']
    }

    onMounted(async () => {
        PIECES.value = (await axiosClient.post(`/focus/pieces`, data)).data.data;
        SELECTED.value = PIECES.value[ORDER.value];

    });


    function nextPiece() {

    }


    return {PIECES, ORDER, SELECTED, isLoading}
}