<script setup>
defineProps(['label'])
</script>
<template>
    <div class="bg-text text-bg hover:underlineborder px-2 w-fit h-fit hover:bg-bg hover:text-text cursor-pointer  border border-text ">
        <h3>{{ label }}</h3>
    </div>
</template>