<script setup>
import router from "../router";

defineProps(["collage"]);
</script>

<template>
    <!-- <h1>{{ collage }}</h1> -->
    <div class="p-2 col-span-2 row-span-1 w-full grid grid-cols-2 gap-4 border border-text">
        <div class="overflow-hidden">
            <img class="aspect-square object-cover  w-full col-span-1" :src="collage.profile.picture" alt="">
        </div>
        <div class="col-start-2 col-span-1 flex flex-col text-left justify-end">


            <b @click="router.push(`/creator/collage/${collage.id}`)" v-if="collage.administered" class="cursor-pointer hover:underline font-bold text-2xl">A/{{ collage.firstname + " " + collage.lastname
            }}</b>
            <b @click="router.push(`/creator/user/${collage.id}`)" v-else class="cursor-pointer hover:underline font-bold text-2xl">U/{{ collage.firstname + " " + collage.lastname
            }}</b>
            <b class="font-bold" v-if="collage.main_medium != 'None'">{{ collage.main_medium}} </b>
        </div>
    </div>
</template>