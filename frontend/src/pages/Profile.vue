<script setup>
import { useRoute } from 'vue-router';
import router from '../router';
import { onMounted, ref } from 'vue';
import axiosClient from '../axios';

const id = useRoute().params.id

const USER = ref(null)
onMounted(async()=>{
    USER.value = (await axiosClient.get(`/creator/${id}`))
})

</script>

<template>
    <main>
        <div class="grid grid-cols-5 gap-4">
            <div class="flex flex-col justify-between">
                <div>
                    <img class="w-fit aspect-square"
                        src="http://localhost:8000/storage/pieces/n00J88tZSeN1LRILtG8EEODRcDLNe3a4VH2ImWgH.jpg" alt="">
                    <h3 class="font-extrabold text-2xl cursor-pointer hover:underline" @click="router.push(`/creator/2`)">Artist</h3>
                </div>
                <div class="flex flex-col text-2xl font-bold">
                    <h4 class="hover:underline cursor-pointer">CONTACT</h4>
                    <h4 class="hover:underline">CONTACT</h4>
                    <h4 class="hover:underline">CONTACT</h4>
                </div>
            </div>

            <div class="col-start-3 col-span-3 font-bold text-3xl text-justify w-full">
                <p>There is no strife, no prejudice, no national conflict in outer space as yet. Its hazards are hostile
                    to us all. Its conquest deserves the best of all mankind, and its opportunity for peaceful
                    cooperation many never come again. But why, some say, the moon? Why choose this as our goal? And
                    they may well ask why climb the highest mountain? Why, 35 years ago, fly the Atlantic? Why does Rice
                    play Texas?</p>
            </div>
        </div>
    </main>
</template>