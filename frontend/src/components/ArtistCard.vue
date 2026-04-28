<script setup>
import router from "../router";

defineProps(["artist"]);
</script>

<template>
    <!-- <h1>{{ artist }}</h1> -->
    <div class="p-2 col-span-2 row-span-1 w-full grid grid-cols-2 gap-4 border border-text">
        <div class="overflow-hidden">
            <img class="aspect-square object-cover  w-full col-span-1" :src="artist.profile.picture" alt="">
        </div>
        <div class="col-start-2 col-span-1 flex flex-col text-left justify-end">


            <b @click="router.push(`/creator/artist/${artist.id}`)" v-if="artist.administered" class="cursor-pointer hover:underline font-bold text-2xl">A/{{ artist.firstname + " " + artist.lastname
            }}</b>
            <b @click="router.push(`/creator/user/${artist.id}`)" v-else class="cursor-pointer hover:underline font-bold text-2xl">U/{{ artist.firstname + " " + artist.lastname
            }}</b>
            <b class="font-bold" v-if="artist.main_medium != 'None'">{{ artist.main_medium}} </b>
        </div>
    </div>
</template>