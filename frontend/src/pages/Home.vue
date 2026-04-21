<script setup>
import axiosClient from "../axios";
import { onMounted, onUnmounted, ref, watchEffect } from "vue";
import { loadPieces } from "../services/PieceService";
import PieceCard from "../components/PieceCard.vue";
import router from "../router";
import { useRoute } from "vue-router";

const IMAGES = ref([]);
const scrollComponent = ref(null);

const loadMorePieces = async () => {
  let newPieces = await loadPieces();

  IMAGES.value.push(...newPieces);
};

/* watchEffect(async() => {
  console.log('enter');

  const filters = useRoute().params
  IMAGES.value = (await axiosClient.post("/index", filters)).data.data.pieces;
  if(filters.value)
    console.log(filters.value);

}) */
onMounted(async () => {
  const filters = useRoute().params
  IMAGES.value = (await axiosClient.post("/index", filters)).data.data.pieces;


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
