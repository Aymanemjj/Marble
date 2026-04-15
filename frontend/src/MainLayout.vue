<script setup>
import { RouterView } from 'vue-router';
import { signOut } from './services/auth';
import BasicInput from './components/BasicInput.vue';
import BasicButton from './components/BasicButton.vue';

let Auth = JSON.parse(localStorage.getItem('user'))

</script>

<template>

    <nav class="mb-8">
        <div>
            <ul class="grid grid-cols-5 gap-4 items-center text-center font-bold text-2xl">
                <RouterLink to="/"
                    class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">
                    Marble</RouterLink>
                <RouterLink to="/focus" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>
                <RouterLink to="/about" class="cursor-pointer hover:underline">About</RouterLink>
                <RouterLink v-if="!Auth" to="/register"
                    class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">
                    JoinUs</RouterLink>
                <button v-else v-on:click="signOut()"
                    class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">
                    Log Out
                </button>
            </ul>
        </div>
    </nav>

    <RouterView />

    <footer class="bg-text grid grid-cols-5 grid-rows-4 gap-4 text-bg mt-8">

        <div class="col-start-4 col-span-2">
            <form action="" class="grid grid-cols-2 ">
                <BasicInput label="" name="email" type="text" />
                <button type="submit"
                    class="cursor-pointer text-2xl font-extrabold border border-bg hover:bg-bg hover:text-text">Subscribe</button>
            </form>
        </div>

        <div class="row-start-2">
            <ul class="flex flex-col font-extrabold text-3xl">
                <RouterLink to="/" class="cursor-pointer hover:underline">
                    Marble</RouterLink>
                <RouterLink to="/focus" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>
                <RouterLink to="/about" class="cursor-pointer hover:underline">About</RouterLink>
            </ul>
        </div>

        <div class="row-start-2 col-start-2">
            <ul class="flex flex-col font-extrabold text-3xl">
                <RouterLink to="/policies/privacy" class="cursor-pointer hover:underline">
                    Privacy Policies</RouterLink>
                <RouterLink to="/focus" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>
                <RouterLink to="/about" class="cursor-pointer hover:underline">About</RouterLink>
            </ul>
        </div>

        <div class="row-start-3 row-span-2 col-span-5 text-center pb-0">
            <h2 class="text-[20vw] font-extrabold w-full leading-none mb-0">
                MARBLE
            </h2>
        </div>
    </footer>
</template>