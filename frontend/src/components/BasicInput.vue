<script setup>
defineProps(['label', 'name', 'type', 'modelValue', 'error'])
defineEmits(['update:modelValue'])
</script>

<template>
    <div class="flex flex-col">
        <label :for="name" class="font-bold text-sm">{{ label }}</label>
        <input :type="type" :name="name" :value="modelValue" 
            @input="$emit('update:modelValue', $event.target.value)"
            class="border border-text bg-bg h-12 text-sm" />
        <span v-if="error" class="text-red-800 text-sm font-bold">
            {{ error[0] }}
        </span>
    </div>
</template>