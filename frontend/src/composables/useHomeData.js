import { onMounted, onUnmounted, ref, watchEffect } from "vue";
import { loadPieces } from "../services/PieceService";
import { useRoute } from "vue-router";
import router from "../router";

export function useHomeData() {
    const items = ref([]);
    const scrollComponent = ref(null);
    const selectedTab = ref("Pieces")


    const loadMorePieces = async () => {
        let newPieces = await loadPieces();
        items.value.push(...newPieces);
    };

    watchEffect(async () => {

        try {
            items.value = await loadPieces(router.currentRoute.value?.query)
        } catch (err) {

            console.log(err);

        }
    })
    onMounted(async () => {

        items.value = await loadPieces(router.currentRoute.value?.query)

        window.addEventListener("scroll", handleScroll);
    });

    onUnmounted(() => {
        window.removeEventListener("scroll", handleScroll);
    });

    const handleScroll = (e) => {
        let element = scrollComponent.value;
        if (element.getBoundingClientRect().bottom < window.innerHeight - 700) {
            loadMorePieces();
        }
    };

    return { items, scrollComponent, selectedTab }

}