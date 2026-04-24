<script setup>
defineProps(['label', 'type'])
</script>

<template>
    <button :type="type" class="bg-bg text-text font-bold text-2xl text-center border border-0.5 border-text h-12 hover:bg-text hover:text-bg cursor-pointer" >{{ label }}</button>
</template>