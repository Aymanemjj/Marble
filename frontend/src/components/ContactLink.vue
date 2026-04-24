<script setup>
defineProps(['link', 'name'])
</script>

<template>
<a :href="link">{{ name }}</a>
</template>