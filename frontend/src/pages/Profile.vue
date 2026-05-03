<script setup>
import router from "../router";
import Loading from "../components/Loading.vue";
import { useAuthProfile } from "../composables/useAuthProfile";


const { AUTH, isLoading } = useAuthProfile();


</script>

<template>
  <Loading v-if="isLoading" />
  <main class="grid grid-cols-5 auto-rows-[25vh] gap-4">
    <div class="h-full aspect-square">
      <img :src="AUTH.profile.picture" alt="" class="">
    </div>
    <div class="flex gap-2 items-end">

      <h3 class="text-2xl font-bold">
        {{ [AUTH.firstname, AUTH.middlename !== 'None' ? AUTH.middlename : null, AUTH.lastname].filter(Boolean).join('').toUpperCase() }}
      </h3>
      <RouterLink to="/profile/followee" class="text-text font-bold hover:underline text-md">See your followees
      </RouterLink>
    </div>
    <div class="row-start-2 col-span-2">
      <p class="text-3xl font-bold w-full text-justify">{{ AUTH.profile.biography.toUpperCase() }}</p>
    </div>

    <div class="col-span-3 row-span-3 w-full h-full relative group">
      <img :src="AUTH.profile.banner" alt="" class="w-full object-contain max-h-full">
      <button
        class="absolute inset-0 m-auto w-fit h-fit opacity-0 group-hover:opacity-100 transition-opacity
               bg-bg hover:bg-text text-text hover:text-bg px-4 py-2 border border-text hover:border-bg hover:underline cursor-pointer"
        @click="router.push('/profile/edit')">
        Edit Banner
      </button>
    </div>

    <!-- <div v-if="AUTH.administered">
      <a :href="contact.path" v-for="contact in AUTH.contacts">{{ contact.name }}</a>
    </div> -->

    <div class="row-start-4 row-span-2 col-span-2 w-full h-full">
      <img :src="AUTH.profile.fav_piece_1.path" alt="" class="w-full object-contain max-h-full ">
    </div>
    <div class="row-start-4 col-start-3 items-end flex">
      <h2 class="text-2xl font-bold">{{ AUTH.profile.fav_piece_1.title.toUpperCase() }}</h2>
    </div>
    <div class="row-start-5 col-start-3 col-span-3 flex items-end">
      <p class="text-2xl font-bold text-justify">{{ AUTH.profile.fav_piece_1.story.toUpperCase() }}</p>
    </div>

    <div class="row-start-6 col-start-1 items-end flex">
      <h2 class="text-2xl font-bold">{{ AUTH.profile.fav_piece_2.title.toUpperCase() }}</h2>
    </div>
    <div class="row-start-7 col-start-1 col-span-3 flex items-end">
      <p class="text-2xl font-bold text-justify">{{ AUTH.profile.fav_piece_1.story.toUpperCase() }}</p>
    </div>

    <div class="row-start-6 row-span-2 col-span-2 col-start-4 w-full h-full">
      <img :src="AUTH.profile.fav_piece_2.path" alt="" class="w-full object-contain max-h-full ">
    </div>

    <div class="row-start-8 col-start-4 col-span-2">
      <button @click="router.push(`/profile/gallery/pieces`)"
        class="border-2 border-text text-2xl font-bold h-1/4 text-left w-full cursor-pointer hover:bg-text hover:text-bg hover:border-bg pl-2">
        View full gallery
      </button>

    </div>
  </main>
</template>
