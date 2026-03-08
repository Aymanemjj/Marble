<script setup>
defineProps(['label', 'name', 'type'])
</script>

<template>
    <div class="flex flex-col">
        <label :label="name" class="font-bold text-2xl">{{ label }}</label>
        <input :type="type" :name="name" class="border border-0.5 border-text bg-asscent h-12 text-2xl">
    </div>
</template>