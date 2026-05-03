<script setup>
import { ref } from "vue";
import PieceCard from "../components/PieceCard.vue";
import { useHomeData } from "../composables/useHomeData";
import ArtistCard from "../components/ArtistCard.vue";

const { pieces, creators, scrollComponent, selectedTab } = useHomeData();
</script>

<template>
  <main class="flex flex-col gap-16">
    <div class="flex divide-x divide-solid divide-text">
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
        :class="selectedTab == 'Pieces' ? 'border-b' : ''" @click="selectedTab = 'Pieces'">
        Pieces
      </button>
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
        :class="selectedTab == 'Artists' ? 'border-b' : ''" @click="selectedTab = 'Artists'">
        Artists
      </button>
    </div>

    <div ref="scrollComponent">
      <div v-if="selectedTab == 'Pieces'" class="columns-5 gap-4">
        <div v-for="piece in pieces" :key="piece.id">
          <PieceCard :image="piece" />
        </div>
      </div>

      <div v-else class="grid grid-cols-5 gap-4 auto-rows-[25vh]">
        <ArtistCard v-for="(artist, index) in creators" :key="artist.id" :artist="artist"
          :class="index % 2 === 0 ? 'col-start-1 col-span-2' : 'col-start-4 col-span-2'" />
      </div>
    </div>
  </main>
</template>