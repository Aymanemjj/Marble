import { useRoute } from "vue-router";
import { computed, onMounted, onUnmounted, ref } from "vue";
import axiosClient from "../axios";


export function useGallery() {
    const route = useRoute()
    const id = route.params.id;
    const type = route.params.creatorType;

    const GALLERY = ref(null);
    const isLoading = computed(() => GALLERY.value == null);


    onMounted(async () => {
        GALLERY.value = (await axiosClient.get(`/creator/${type}/${id}/gallery`)).data.data;
    });

    return {GALLERY, isLoading}
}