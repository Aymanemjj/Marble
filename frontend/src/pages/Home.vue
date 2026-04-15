<script setup>
import axiosClient from '../axios';
import { onMounted, onUnmounted, ref, watchEffect } from 'vue';
import { loadPieces } from '../services/PieceService';

const IMAGES = ref([])
const scrollComponent = ref(null)

const loadMorePieces =async ()=>{
    let newPieces = await loadPieces()

    IMAGES.value.push(...newPieces)
}

onMounted(async () => {
    IMAGES.value = (await axiosClient.get('/index')).data.data.pieces;

    window.addEventListener('scroll', handleScroll)

})

onUnmounted(()=>{
    window.removeEventListener('scroll', handleScroll)
})
 const handleScroll = (e)=>{
    
    let element = scrollComponent.value
    if( element.getBoundingClientRect().bottom < window.innerHeight - 700){

        loadMorePieces()
    }
 }





</script>

<template>
    <main class="columns-5 gap-4 " ref="scrollComponent">

        <div v-for="image in IMAGES" class="break-inside-avoid mb-4 relative group overflow-hidden bg-text">

            <img :src="image.path" class="w-full h-auto transition-transform duration-300 group-hover:scale-90">

            <div
                class="absolute inset-0 flex items-end justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="bg-bg text-text px-4 py-2 border border-text cursor-pointer" @click="">
                    Save
                </button>
            </div>
        </div>
        
    </main>
</template>