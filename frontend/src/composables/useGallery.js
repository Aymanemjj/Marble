import { useRoute } from "vue-router";
import { computed, onMounted, onUnmounted, ref } from "vue";
import axiosClient from "../axios";


export function useGallery() {
    const route = useRoute()
    const selectedTab = ref('Pieces')

    const GALLERY = ref(null);
    const isLoading = computed(() => GALLERY.value == null);

    const hasNoPieces = computed(() => GALLERY.value != null && GALLERY.value.pieces.length === 0)
    const hasNoCollages = computed(() => GALLERY.value != null && GALLERY.value.collages.length === 0)

    onMounted(async () => {
        GALLERY.value = (await axiosClient.get(`/creator/${route.params.creatorType}/${route.params.id}/gallery`)).data.data;
    });

    return {GALLERY, isLoading, selectedTab, hasNoPieces, hasNoCollages}
}