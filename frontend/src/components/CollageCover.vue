<script setup>
import router from "../router";
defineProps(["collage"]);
</script>

<template>
  <div class="flex flex-col flex-nowrap mb-4 gap-2">
    <div class="cursor-pointer break-inside-avoid relative group overflow-hidden bg-text">
      <div @click="router.push(`/collage/${collage.id}`)">
        <img
          v-if="collage.pieces.length"
          :src="collage.pieces[0].path"
          class="w-full h-auto transition-transform duration-300 group-hover:scale-90 group-active:scale-80"
        />
        <div v-else class="w-full aspect-square bg-asscent" />
      </div>
      <div class="absolute inset-0 flex self-end justify-self-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-fit w-fit">
        <button
          class="bg-bg hover:bg-text text-text hover:text-bg px-4 py-2 border border-text hover:border-bg hover:underline cursor-pointer"
          @click="router.push(`/collage/${collage.id}`)">
          View
        </button>
      </div>
    </div>
    <b class="">{{ collage.title }}</b>
  </div>
</template>