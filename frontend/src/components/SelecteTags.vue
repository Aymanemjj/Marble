<script setup>
import { onMounted, ref } from 'vue';
import SelectableTag from './SelectableTag.vue';
import axiosClient from '../axios';

const TAGS = ref([])
onMounted(async () => {
    TAGS.value = (await axiosClient.get('/tags/list')).data.data.tags;
});
defineProps(['selectedTags'])
const selected = ref([])
const emit = defineEmits(['update:modelValue'])

function toggle(id) {
    const i = selected.value.indexOf(id)
    if (i === -1) {
        if (selected.value.length >= 5) return
        selected.value.push(id)
    } else {
        selected.value.splice(i, 1)
    }
    emit('update:modelValue', selected.value)
}
</script>

<template>

    <div class="flex flex-col gap-2 w-full">
        <h3 class="font-bold text-sm">
            Pick up to 5 tags
        </h3>
        <div class="hidden">
            {{ selected = selectedTags ?? [] }}
        </div>
        <div class="flex w-full h-fit flex-wrap gap-2">
            <SelectableTag v-for="tag in TAGS" :key="tag.id" :label="tag.name" :selected="selected.includes(tag.id)"
                @click="toggle(tag.id)" />
        </div>
    </div>
</template>