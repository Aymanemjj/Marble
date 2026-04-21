<script setup>
import { useRoute } from "vue-router";
import router from "../router";
import { computed, onMounted, onUnmounted, ref } from "vue";
import axiosClient from "../axios";
import LoadingProfile from "../components/LoadingProfile.vue";
import Loading from "../components/Loading.vue";
import PieceCover from "../components/PieceCover.vue";

const id = useRoute().params.id;
const type = useRoute().params.creatorType;

const GALLERY = ref(null);
const isLoading = computed(() => GALLERY.value == null);
const scrollComponent = ref(null);

const loadMorePieces = async () => {
    let newPieces = await loadPieces();

    IMAGES.value.push(...newPieces);
};

onMounted(async () => {
    GALLERY.value = (await axiosClient.get(`/creator/${type}/${id}/gallery`)).data.data;
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
</script>

<template>

    <Loading v-if="isLoading" />

    <main class="columns-5 gap-4" ref="scrollComponent">
        <div v-for="piece in GALLERY" class="">
            <PieceCover :piece="piece" />
        </div>
    </main>
</template>