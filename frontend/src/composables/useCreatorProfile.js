// useCreatorProfile.js
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import axiosClient from "../axios";
import { useAxiosRequest } from "./useAxiosRequest";

export function useCreatorProfile() {
    const route = useRoute()
    const id = route.params.id;
    const type = route.params.creatorType;
    const CREATOR = ref(null);
    const isLoading = computed(() => CREATOR.value == null);
    const isFollowing = ref(false);

    onMounted(async () => {
        CREATOR.value = (await axiosClient.get(`/creator/${type}/${id}`)).data.data;
        isFollowing.value = CREATOR.value.is_following
    });

    async function followToggle() {
        if (isFollowing.value) {
            await useAxiosRequest('delete', `/unfollow/${type}/${id}`, false)
        } else {
            await useAxiosRequest('post', `/follow/${type}/${id}`, false)
        }
        isFollowing.value = !isFollowing.value
    }

    return { CREATOR, isLoading, type, id, isFollowing, followToggle }
}