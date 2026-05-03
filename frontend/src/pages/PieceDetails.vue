<script setup>
import Tag from "../components/Tag.vue";
import router from "../router";
import ContactLink from "../components/ContactLink.vue";
import Loading from "../components/Loading.vue";
import { usePieceDetails } from "../composables/usePieceDetails";
import { useAuthStore } from "../stores/useAuthStore";
import { deletePiece, editPiece } from "../services/PieceService";
import AddToCollageModal from "../components/AddToCollageModal.vue";
import { ref } from "vue";

const { PIECE, isLoading } = usePieceDetails();
const auth = useAuthStore()
const showModal = ref(false);

</script>

<template>
  <Loading v-if="isLoading" />
  <main v-else class="flex flex-col gap-16">
    <div>
      <div class="bg-text w-full  h-220 flex items-center">
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
        <div class="flex gap-4">
          <button
            class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer"
            @click="showModal = true">
            Save
          </button>
          <div v-if="PIECE.creator.id === auth.auth.id" class="flex gap-2">
            <button
              class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer"
              @click="editPiece(PIECE.id)">
              Edit
            </button>
            <button
              class="bg-text text-bg hover:underline hover:bg-red-800 hover:text-bg border border-bg hover:border-text px-2 cursor-pointer"
              @click="deletePiece(PIECE.id)">
              Delete
            </button>
          </div>
        </div>
        <div class="flex gap-2">
          <Tag v-for="tag in PIECE.tags" :label="tag.name" />
        </div>
      </div>
    </div>

    <div class="grid grid-cols-5 gap-4 ">
      <div class="flex flex-col justify-between">
        <div>
          <img class="w-fit aspect-square" :src="PIECE.creator.profile.picture" alt="" />
          <h3 class="cursor-pointer hover:underline font-bold text-2xl"
            @click="router.push(`/creator/${PIECE.administered ? 'artist' : 'user'}/${PIECE.creator.id}`)">
            {{ PIECE.administered ? 'A' : 'U' }}/{{ PIECE.creator.firstname }} {{ PIECE.creator.lastname }}
          </h3>
        </div>
        <div class="flex flex-col text-2xl font-bold">
          <ContactLink v-for="contact in PIECE.creator.contacts" :key="contact.name" :href="contact.link"
            :name="contact.name" />
        </div>
      </div>

      <div class="col-start-3 col-span-3 font-bold text-3xl text-justify">
        <p class="wrap-break-word">{{ PIECE.story }}</p>
      </div>
    </div>

  </main>

  <AddToCollageModal v-if="showModal" :piece_id="PIECE.id" @close="showModal = false" />
</template>