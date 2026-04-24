import { computed, onMounted, reactive, ref, watchEffect } from "vue";
import axiosClient from "../axios";
import { useRoute } from "vue-router";


export function usePieceDetails() {

    const PIECE = ref(null);
    const isLoading = computed(() => PIECE.value == null);
    onMounted(async () => {
        PIECE.value = (await axiosClient.get(`/piece/${useRoute().params.id}`)).data.data.piece;
    });

    return {PIECE, isLoading}
}