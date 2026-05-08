import { computed } from "vue";
import { useAuthStore } from "../stores/useAuthStore"

export function useAuthProfile() {
    const authStore = useAuthStore()
    authStore.initialize()
    const isLoading = computed(() => authStore.auth.check == false);

    return { AUTH: authStore.auth, isLoading }
}