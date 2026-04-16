<script setup>
import router from '../router';

defineProps(['image'])
</script>

<template>
    <div class="flex flex-col mb-4 gap-2">
        <div class="cursor-pointer break-inside-avoid  relative group overflow-hidden bg-text">
            <div @click="router.push(`/piece/${image.id}`)">
                <img :src="image.path" class="w-full h-auto transition-transform duration-300 group-hover:scale-90 group-active:scale-80">
            </div>

            <div
                class="absolute inset-0 flex  self-end justify-self-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-fit w-fit ">
                <button
                    class="bg-bg hover:bg-text text-text  hover:text-bg px-4 py-2 border border-text hover:border-bg hover:underline cursor-pointer"
                    @click="console.log('save')">
                    Save
                </button>
            </div>
        </div>
        <div class="flex gap-4">
            <div class=" aspect-square w-8">
            <img :src="image.path" alt="" class="bg-contain">
            </div>
            <div class="flex flex-col">
                <h2>{{ image.title }}</h2>
                <h3 @click="router.push(`/creator/${image.creator.id}`)" class="cursor-pointer hover:underline"> U/{{ image.creator.firstname }} {{ image.creator.firstname }}</h3>
            </div>
        </div>
    </div>
</template>
