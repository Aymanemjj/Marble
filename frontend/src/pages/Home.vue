<script setup>
import axiosClient from "../axios";
import { onMounted, onUnmounted, ref, watchEffect } from "vue";
import { loadPieces } from "../services/PieceService";
import PieceCard from "../components/PieceCard.vue";
import router from "../router";
import { useRoute } from "vue-router";

const ITEMS = ref([]);
const scrollComponent = ref(null);

const TAB = ref("Pieces")

const loadMorePieces = async () => {
  let newPieces = await loadPieces();

  ITEMS.value.push(...newPieces);
};


onMounted(async () => {
  ITEMS.value = await loadPieces()
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


  <main class="flex flex-col gap-16">

    <div class="flex divide-x divide-solid divide-text">
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer "
        :class="TAB == 'Pieces' ? 'border-b' : ''" @click="TAB = 'Pieces'">
        Pieces
      </button>
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
        :class="TAB == 'Artist' ? 'border-b' : ''" @click="TAB = 'Artist'">
        Artists
      </button>
    </div>


    <div v-if="TAB == 'Pieces'" class="columns-5 gap-4" ref="scrollComponent">
      <div v-for="image in ITEMS" class="">
        <PieceCard :image="image" />
      </div>
    </div>

    <div v-else class="columns-5 gap-4" ref="scrollComponent">
      <div  class="">
      Artist
      </div>
    </div>
  </main>
</template>
