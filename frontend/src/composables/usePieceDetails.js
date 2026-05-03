import { computed, onMounted, onUnmounted, reactive, ref, watchEffect } from "vue";
import axiosClient from "../axios";
import { useRoute } from "vue-router";
import { useAxiosRequest } from "./useAxiosRequest";


export function usePieceDetails() {

    const PIECE = ref(null);
    const isLoading = computed(() => PIECE.value == null);
    const timePast = ref(0);
    let interval = null

    function startTimer() {
        clearInterval(interval)
        timePast.value = 0
        interval = setInterval(() => {
            timePast.value++
        }, 1000)
    }

    onMounted(async () => {
        PIECE.value = (await axiosClient.get(`/piece/${useRoute().params.id}`)).data.data.piece;
        startTimer()
    });

    onUnmounted(async () => {
        if (timePast.value >= 3) {
            clearInterval(interval)
            await useAxiosRequest("post", '/algo/prefs/set', { piece_id: PIECE.value.id, duration: timePast.value })
        }
    });

    return { PIECE, isLoading }
}