<script setup>
import router from "../router";
import PieceCover from "./PieceCover.vue";

defineProps(["image"]);
</script>

<template>
  <div class="flex flex-col flex-nowrap mb-4 gap-2">
    <PieceCover :piece="image" />  
    <div class="flex gap-4">
      <div class="aspect-square w-12">
        <img :src="image.creator.profile.picture" alt="" class="bg-contain" />
      </div>
      <div class="flex flex-col">
        <h2>{{ image.title }}</h2>
        <h3 v-if="image.administered" @click="router.push(`/creator/artist/${image.creator.id}`)"
          class="cursor-pointer hover:underline">
          A/{{ image.creator.firstname }} {{ image.creator.lastname }}
        </h3>
        <h3 v-else @click="router.push(`/creator/user/${image.creator.id}`)" class="cursor-pointer hover:underline">
          U/{{ image.creator.firstname }} {{ image.creator.lastname }}
        </h3>
      </div>
    </div>
  </div>
</template>
