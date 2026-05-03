import { computed, onMounted, onUnmounted, ref } from "vue";
import axiosClient from "../axios";
import { useAuthStore } from "../stores/useAuthStore";


export function useAuthGallery() {
    const GALLERY = ref(null);

    const isLoading = computed(() => GALLERY.value == null);
    const hasNoPieces = computed(() => GALLERY.value != null && GALLERY.value.pieces.length === 0)
    const hasNoCollages = computed(() => GALLERY.value != null && GALLERY.value.collages.length === 0)

    const selectedTab = ref("Pieces");

    onMounted(async () => {
        GALLERY.value = (await axiosClient.get(`/profile`)).data.data;
        console.log(GALLERY.value);
    });

    return { GALLERY, isLoading, hasNoPieces, hasNoCollages, selectedTab }
}