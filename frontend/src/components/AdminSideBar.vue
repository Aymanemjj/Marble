<script setup>
const links = [
    { label: 'Dashboard', path: '/administration/dashboard' },
    { label: 'Tags', path: '/administration/tags' },
    { label: 'Artists', path: '/administration/artists' },]
</script>

<template>
    <div class="h-180 w-48 bg-asscent flex flex-col p-4 gap-1 left-0 overflow-y-auto">
        <h2 class="font-bold text-xs uppercase tracking-widest text-text/40 mb-4">Marble Admin</h2>
        <RouterLink v-for="link in links" :key="link.path" :to="link.path"
            class="px-3 py-2 text-sm uppercase tracking-widest border border-transparent hover:underline transition-colors"
            :class="{ 'bg-text text-bg': $route.path === link.path, 'text-text': $route.path !== link.path }">
            {{ link.label }}
        </RouterLink>
    </div>
</template>