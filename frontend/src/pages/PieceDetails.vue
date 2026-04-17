<script setup>
import { computed, onMounted, reactive, ref, watchEffect } from "vue";
import axiosClient from "../axios";
import Tag from "../components/Tag.vue";
import router from "../router";
import LoadingPD from "../components/LoadingPD.vue";
import ContactLink from "../components/ContactLink.vue";
import { useRoute } from "vue-router";

const PIECE = ref(null);
const isLoading = computed(() => PIECE.value == null);
const id = useRoute().params.id;
onMounted(async () => {
  PIECE.value = (await axiosClient.get(`/piece/${id}`)).data.data.piece;
});
</script>

<template>
  <LoadingPD v-if="isLoading" />
  <main v-else class="flex flex-col gap-16">
    <div>
      <div class="bg-text w-full h-screen flex items-center align-middle">
        <img :src="PIECE.path" class="w-full object-contain max-h-full" />
      </div>
      <div class="font-extrabold flex justify-between">
        <div class="text-2xl">
          <h2>{{ PIECE.title }}</h2>
        </div>
        <div class="text-2xl">
          <h2>By: {{ PIECE.creator.firstname }} {{ PIECE.creator.lastname }}</h2>
        </div>
      </div>
      <div class="flex justify-between">
        <div>
          <button
            class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer"
          >
            Save
          </button>
        </div>
        <div class="flex gap-2">
          <Tag v-for="tag in PIECE.tags" :label="tag" />
        </div>
      </div>
    </div>

    <div class="grid grid-cols-5 gap-4">
      <div class="flex flex-col justify-between">
        <div>
          <img
            class="w-fit aspect-square"
            src="http://localhost:8000/storage/pieces/n00J88tZSeN1LRILtG8EEODRcDLNe3a4VH2ImWgH.jpg"
            alt=""
          />
          <h3
            class="font-extrabold text-2xl cursor-pointer hover:underline"
            @click="router.push(`/creator/${PIECE.creator.id}`)"
          >
            U/{{ PIECE.creator.firstname }} {{ PIECE.creator.lastname }}
          </h3>
        </div>
        <div class="flex flex-col text-2xl font-bold">
          <ContactLink
            v-for="contact in PIECE.creator.contacts"
            :href="contact.link"
            :name="contact.name"
          />
        </div>
      </div>

      <div class="col-start-3 col-span-3 font-bold text-3xl text-justify w-full">
        <p>{{ PIECE.story }}</p>
      </div>
    </div>
  </main>
</template>
