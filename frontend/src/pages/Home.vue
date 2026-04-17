<script setup>
import axiosClient from "../axios";
import { onMounted, onUnmounted, ref, watchEffect } from "vue";
import { loadPieces } from "../services/PieceService";
import PieceCard from "../components/PieceCard.vue";

const IMAGES = ref([]);
const scrollComponent = ref(null);

const loadMorePieces = async () => {
  let newPieces = await loadPieces();

  IMAGES.value.push(...newPieces);
};

onMounted(async () => {
  IMAGES.value = (await axiosClient.get("/index")).data.data.pieces;
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
  <main class="columns-5 gap-4" ref="scrollComponent">
    <div v-for="image in IMAGES" class="">
      <PieceCard :image="image" />
    </div>
  </main>
</template>
