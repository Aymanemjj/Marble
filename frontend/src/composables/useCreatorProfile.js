import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import axiosClient from "../axios";

export function useCreatorProfile() {
    const route = useRoute()
    const id = route.params.id;
    const type = route.params.creatorType;

    const CREATOR = ref(null);
    const isLoading = computed(() => CREATOR.value == null);

    onMounted(async () => {
        CREATOR.value = (await axiosClient.get(`/creator/${type}/${id}`)).data.data;


    });

    return {CREATOR, isLoading, type, id}
}