<script setup>
import Tag from "../components/Tag.vue";
import router from "../router";
import ContactLink from "../components/ContactLink.vue";
import Loading from "../components/Loading.vue";
import { usePieceDetails } from "../composables/usePieceDetails";

const {PIECE, isLoading} = usePieceDetails();

</script>

<template>
  <Loading v-if="isLoading" />
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
            class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer">
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
          <img class="w-fit aspect-square"
            src="http://localhost:8000/storage/pieces/n00J88tZSeN1LRILtG8EEODRcDLNe3a4VH2ImWgH.jpg" alt="" />
          <h3 v-if="PIECE.administered" @click="router.push(`/creator/artist/${PIECE.creator.id}`)"
            class="cursor-pointer hover:underline font-bold text-2xl">
            A/{{ PIECE.creator.firstname }} {{ PIECE.creator.lastname }}
          </h3>
          <h3 v-else @click="router.push(`/creator/user/${PIECE.creator.id}`)" class="cursor-pointer hover:underline font-bold text-2xl">
            U/{{ PIECE.creator.firstname }} {{ PIECE.creator.lastname }}
          </h3>

        </div>
        <div class="flex flex-col text-2xl font-bold">
          <ContactLink v-for="contact in PIECE.creator.contacts" :href="contact.link" :name="contact.name" />
        </div>
      </div>

      <div class="col-start-3 col-span-3 font-bold text-3xl text-justify w-full">
        <p>{{ PIECE.story }}</p>
      </div>
    </div>
  </main>
</template>
