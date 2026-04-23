<script setup>
import { ref } from "vue";
import PieceCard from "../components/PieceCard.vue";
import { useHomeData } from "../composables/homePage";


const {items, scrollComponent, selectedTab} = useHomeData();

</script>

<template>


  <main class="flex flex-col gap-16">

    <div class="flex divide-x divide-solid divide-text">
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer "
        :class="selectedTab == 'Pieces' ? 'border-b' : ''" @click="selectedTab = 'Pieces'">
        Pieces
      </button>
      <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
        :class="selectedTab == 'Artist' ? 'border-b' : ''" @click="selectedTab = 'Artist'">
        Artists
      </button>
    </div>


    <div v-if="selectedTab == 'Pieces'" class="columns-5 gap-4" ref="scrollComponent">
      <div v-for="image in items" class="">
        <PieceCard :image="image" />
      </div>
    </div>

    <div v-else class="columns-5 gap-4" ref="scrollComponent">
      <div class="">
        Artist
      </div>
    </div>
  </main>
</template>
