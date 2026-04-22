<script setup>
import { computed, onMounted, reactive, ref, watchEffect } from "vue";
import axiosClient from "../axios";
import Tag from "../components/Tag.vue";
import router from "../router";
import ContactLink from "../components/ContactLink.vue";
import { useRoute } from "vue-router";
import Loading from "../components/Loading.vue";

const PIECES = ref(null);
const ORDER = ref(0);
const PIECE = ref(null);
const isLoading = computed(() => PIECES.value == null);

const data = {
  tags: ['Watercolor']
}

onMounted(async () => {
  PIECES.value = (await axiosClient.post(`/focus/pieces`, data)).data.data;
  PIECE.value = PIECES.value[ORDER.value];

});


function nextPiece() {

}
</script>

<template>
  <Loading v-if="isLoading" />
  <main v-else class="grid grid-cols-5 auto-rows-[25vh] gap-4 grid-rows-4">
    <div class="bg-text w-full flex items-center align-middle col-span-5 row-span-2">
      <img :src="PIECE.path" class=" object-contain w-full" />
    </div>
  </main>
</template>
