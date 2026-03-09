<script setup>
import { RouterView } from 'vue-router';
import { signOut } from './auth';

let Auth = JSON.parse(localStorage.getItem('user'))

</script>

<template>

    <nav>
        <div>
            <ul class="grid grid-cols-5 gap-16 items-center text-center font-bold text-2xl">
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

</template>