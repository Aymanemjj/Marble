<script setup>
import AddToCollageModal from "../components/AddToCollageModal.vue";
import ContactLink from "../components/ContactLink.vue";
import Loading from "../components/Loading.vue";
import Tag from "../components/Tag.vue";
import { useFocusPiece } from "../composables/useFocusPiece";
import router from "../router";
import { deletePiece, editPiece } from "../services/PieceService";
import { useAuthStore } from "../stores/useAuthStore";


const { focusStore, isLoading, showModal, display } = useFocusPiece()
const auth = useAuthStore()

</script>

<template>
  <Loading v-if="isLoading" />
  <main v-else class="flex flex-col gap-16">
    <div>
      <div class="bg-text w-full h-220 flex items-center">
        <img :src="focusStore.currentPiece.path" class="w-full object-contain max-h-full" />
      </div>
      <div class="font-extrabold flex justify-between">
        <div class="text-2xl">
          <h2>{{ focusStore.currentPiece.title }}</h2>
        </div>
        <div class="text-2xl">
          <h2>By: {{ focusStore.currentPiece.creator.firstname }} {{ focusStore.currentPiece.creator.lastname }}
          </h2>
        </div>
      </div>
      <div class="flex justify-between">
        <div class="flex gap-4">
          <div class="flex flex-col gap-1">
            <button
              class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer"
              @click="showModal = true">
              Save
            </button>
          </div>
          <div>
            <b class="font-bold tabular-nums text-sm text-center">{{ display }}</b>
          </div>
          <div v-if="focusStore.currentPiece.creator.id === auth.auth.id" class="flex gap-2">
            <button
              class="bg-text text-bg hover:underline hover:bg-bg hover:text-text border border-bg hover:border-text px-2 cursor-pointer"
              @click="editPiece(focusStore.currentPiece.id)">
              Edit
            </button>
            <button
              class="bg-text text-bg hover:underline hover:bg-red-800 hover:text-bg border border-bg hover:border-text px-2 cursor-pointer"
              @click="deletePiece(focusStore.currentPiece.id)">
              Delete
            </button>
          </div>
        </div>
        <div class="flex gap-2">
          <Tag v-for="tag in focusStore.currentPiece.tags" :label="tag.name" />
        </div>
      </div>
    </div>
    <div class="grid grid-cols-5 gap-4">
      <div class="flex flex-col justify-between">
        <div>
          <img class="w-fit aspect-square" :src="focusStore.currentPiece.creator.profile.picture" alt="" />
          <h3 class="cursor-pointer hover:underline font-bold text-2xl"
            @click="router.push(`/creator/${focusStore.currentPiece.administered ? 'artist' : 'user'}/${focusStore.currentPiece.creator.id}`)">
            {{ focusStore.currentPiece.administered ? 'A' : 'U' }}/{{ focusStore.currentPiece.creator.firstname }}
            {{ focusStore.currentPiece.creator.lastname }}
          </h3>
        </div>
        <div class="flex flex-col text-2xl font-bold">
          <ContactLink v-for="contact in focusStore.currentPiece.creator.contacts" :key="contact.name"
            :href="contact.link" :name="contact.name" />
        </div>
      </div>
      <div class="col-start-3 col-span-3 font-bold text-3xl text-justify">
        <p class="wrap-break-word">{{ focusStore.currentPiece.story }}</p>
      </div>
    </div>
  </main>
  <AddToCollageModal v-if="showModal" :piece_id="focusStore.currentPiece.id" @close="showModal = false" />
</template>
