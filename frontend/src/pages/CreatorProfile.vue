<script setup>
import router from "../router";
import Loading from "../components/Loading.vue";
import { useCreatorProfile } from "../composables/useCreatorProfile";


const { CREATOR, isLoading, type, id } = useCreatorProfile();


</script>

<template>
  <Loading v-if="isLoading" />
  <main v-else class="grid grid-cols-5 auto-rows-[25vh] gap-4">
    <div class="h-full aspect-square">
      <img :src="CREATOR.profile.picture" alt="" class="">
    </div>
    <div class="flex gap-2 items-end">
      <h3 class="text-2xl font-bold">{{ CREATOR.firstname.toUpperCase() }}</h3>
      <h3 v-if="CREATOR.middlename != 'None'" class="text-2xl font-bold">{{ CREATOR.middlename.toUpperCase() }}</h3>
      <h3 class="text-2xl font-bold">{{ CREATOR.lastname.toUpperCase() }}</h3>
    </div>
    <div class="row-start-2 col-span-2">
      <p class="text-3xl font-bold w-full text-justify">{{ CREATOR.profile.biography.toUpperCase() }}</p>
    </div>

    <div class="col-span-3 row-span-3 w-full h-full">
      <img :src="CREATOR.profile.banner" alt="" class="w-full object-contain max-h-full ">
    </div>

    <div v-if="CREATOR.administered">
      <a :href="contact.path" v-for="contact in CREATOR.contacts">{{ contact.name }}</a>
    </div>
    <div class="row-start-4 row-span-2 col-span-2 w-full h-full">
      <img :src="CREATOR.profile.banner" alt="" class="w-full object-contain max-h-full ">
    </div>
    <div class="row-start-4 col-start-3 items-end flex">
      <h2 class="text-2xl font-bold">{{ CREATOR.firstname.toUpperCase() }}</h2>
    </div>
    <div class="row-start-5 col-start-3 col-span-3 flex items-end">
      <p class="text-2xl font-bold text-justify">{{ CREATOR.profile.biography.toUpperCase() }}</p>
    </div>

    <div class="row-start-6 col-start-1 items-end flex">
      <h2 class="text-2xl font-bold">{{ CREATOR.firstname.toUpperCase() }}</h2>
    </div>
    <div class="row-start-7 col-start-1 col-span-3 flex items-end">
      <p class="text-2xl font-bold text-justify">{{ CREATOR.profile.biography.toUpperCase() }}</p>
    </div>

    <div class="row-start-6 row-span-2 col-span-2 col-start-4 w-full h-full">
      <img :src="CREATOR.profile.banner" alt="" class="w-full object-contain max-h-full ">
    </div>

    <div class="row-start-8 col-start-4 col-span-2">
      <button @click="router.push(`/creator/${type}/${id}/gallery`)"
        class="border-2 border-text text-2xl font-bold h-1/4 text-left w-full cursor-pointer hover:bg-text hover:text-bg hover:border-bg pl-2">
        View full gallery
      </button>

    </div>
  </main>
</template>
