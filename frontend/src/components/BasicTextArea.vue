<script setup>
defineProps(['label', 'name', 'type', 'modelValue', 'error'])
defineEmits(['update:modelValue'])
</script>

<template>
    <div class="flex flex-col">
        <label :for="name" class="font-bold text-sm">{{ label }}</label>
        <textarea :name="name" :id="name" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
            class="border border-text bg-asscent h-36 text-sm px-2 resize-none" /> <span v-if="error"
            class="text-red-800 text-sm font-bold">
            {{ error[0] }}
        </span>
    </div>
</template>