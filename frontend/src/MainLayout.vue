<script setup>
import Register from './pages/Register.vue';


</script>

<template>

    <nav>
        <div>
            <ul class="grid grid-cols-5 gap-16 items-center text-center font-bold text-2xl">
                <li class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">Marble</li>
                <li class="cursor-pointer hover:underline">Focus</li>
                <li class="cursor-pointer hover:underline">Artists</li>
                <li class="cursor-pointer hover:underline">About</li>
                <li class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">JoinUs</li>
            </ul>
        </div>
    </nav>

    <Register />

</template>