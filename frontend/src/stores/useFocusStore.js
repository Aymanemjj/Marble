import { defineStore } from "pinia";
import { useAxiosRequest } from "../composables/useAxiosRequest";

export const useFocusStore = defineStore("focusStore", {
    state: () => ({
        active: false,
        minutes: null,
        seconds: null,
        tags: [],
        pieces: [],
        currentIndex: 0,
        noMorePieces: false,
        noPiecesFound: false,
    }),
    actions: {
        async initialize(settings) {
            this.minutes = settings.minutes
            this.seconds = settings.seconds
            this.tags = settings.tags

            const res = (await useAxiosRequest('post', '/focus/pieces', { tags: this.tags })).data
            if (!res || res.length === 0) {
                this.noPiecesFound = true
                return
            }

            this.pieces = res
            this.active = true
        },
        next() {
            if (this.currentIndex + 1 >= this.pieces.length) {
                this.noMorePieces = true
                return
            }
            this.currentIndex++
        },
        stop() {
            active.value = false
            minutes.value = null
            seconds.value = null
            tags.value = []
            pieces.value = []
            currentIndex.value = 0
            noMorePieces.value = false
            noPiecesFound.value = false
        }
    },
    getters: {
        currentPiece: (state) => state.pieces[state.currentIndex] ?? null,
    }
})