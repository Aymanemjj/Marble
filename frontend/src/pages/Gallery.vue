<script setup>
import Loading from "../components/Loading.vue";
import PieceCover from "../components/PieceCover.vue";
import { useGallery } from "../composables/useGallery";


const {GALLERY, isLoading} = useGallery();


</script>

<template>

    <Loading v-if="isLoading" />

    <main class="columns-5 gap-4">
        <div v-for="piece in GALLERY" class="">
            <PieceCover :piece="piece" />
        </div>
    </main>
</template>