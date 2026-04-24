<script setup>
defineProps(['label', 'name', 'type', 'modelValue'])
defineEmits(['update:modelValue'])
</script>

<template>
    <div class="flex flex-col">
        <label :for="name" class="font-bold text-2xl">{{ label }}</label>
        <input :type="type" :name="name" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
            class="border border-text bg-asscent h-12 text-2xl" />
    </div>
</template>