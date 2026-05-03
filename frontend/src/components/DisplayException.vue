<script setup>

defineProps(['message', 'img'])
</script>

<template>
    <main class="flex flex-col items-center">
        <h2 class="font-bold text-2xl self-center">{{ message }}</h2>
        <img class="scale-100" :src="'/public/error/' + img + '.png'" alt="">
    </main>
</template>