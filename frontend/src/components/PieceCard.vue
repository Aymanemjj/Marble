<script setup>
import router from '../router';
import { pieceDetails } from '../services/PieceService';

defineProps(['image'])
</script>

<template>
    <div class="cursor-pointer">
        <div @click="router.push(`/piece/${image.id}`)">
        <img :src="image.path" class="w-full h-auto transition-transform duration-300 group-hover:scale-90" >
        </div>

        <div
            class="absolute inset-0 flex  self-end justify-self-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-fit w-fit ">
            <button class="bg-bg hover:bg-text text-text  hover:text-bg px-4 py-2 border border-text hover:border-bg hover:underline cursor-pointer" @click="console.log('save')">
                Save
            </button>
        </div>
    </div>
</template>
