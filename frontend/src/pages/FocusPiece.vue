<script setup>
import Loading from "../components/Loading.vue";
import { useFocusPiece } from "../composables/useFocusPiece";


const {PIECES, ORDER, SELECTED, isLoading, nextPiece} = useFocusPiece()
</script>

<template>
  <Loading v-if="isLoading" />
  <main v-else class="grid grid-cols-5 auto-rows-[25vh] gap-4 grid-rows-4">
    <div class="bg-text w-full flex items-center align-middle col-span-5 row-span-2">
      <img :src="SELECTED.path" class=" object-contain w-full" />
    </div>
  </main>
</template>
