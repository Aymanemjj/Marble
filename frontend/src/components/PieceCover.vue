<script setup>
import router from "../router";
import { ref } from "vue";
import AddToCollageModal from "./AddToCollageModal.vue";

defineProps(["piece"]);

const showModal = ref(false);
</script>

<template>
    <div class="flex flex-col flex-nowrap mb-4 gap-2">
        <div class="cursor-pointer break-inside-avoid relative group overflow-hidden bg-text">
            <div @click="router.push(`/piece/${piece.id}`)">
                <img :src="piece.path"
                    class="w-full h-auto transition-transform duration-300 group-hover:scale-90 group-active:scale-80" />
            </div>
            <div
                class="absolute inset-0 flex self-end justify-self-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-fit w-fit">
                <button
                    class="bg-bg hover:bg-text text-text hover:text-bg px-4 py-2 border border-text hover:border-bg hover:underline cursor-pointer"
                    @click="showModal = true">
                    Save
                </button>
            </div>
        </div>

        <AddToCollageModal v-if="showModal" :piece_id="piece.id" @close="showModal = false" />
    </div>
</template>