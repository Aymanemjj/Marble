<script setup>
defineProps(['label', 'selected'])
</script>

<template>
  <div
    class="px-2 w-fit h-fit cursor-pointer border border-text"
    :class="selected ? 'bg-bg text-text' : 'bg-text text-bg hover:underline'"
  >
    <h3>{{ label }}</h3>
  </div>
</template>