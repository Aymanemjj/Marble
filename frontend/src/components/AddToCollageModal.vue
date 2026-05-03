<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from './Loading.vue'
import BasicButton from './BasicButton.vue'



const props = defineProps(['piece_id'])

const emit = defineEmits(['close'])

const collages = ref([])
const isLoading = computed(() => collages.value == null);
const selected = ref(null)

onMounted(async () => {
    const res = await useAxiosRequest('get', '/profile/collage', false)
    collages.value = res.data.collages
})


async function confirm() {
    await useAxiosRequest('post', `/collage/${selected.value}/add/${props.piece_id}`, false)
    emit('close')
}
</script>


<template>
    <div class="fixed inset-0 bg-bg/80 flex items-center justify-center z-50" @click.self="$emit('close')">
        <div class="bg-asscent p-4 w-96 flex flex-col gap-4">

            <div class="flex items-center justify-between">
                <h2 class="text-text uppercase tracking-widest text-sm">Save to Collage</h2>
                <button class="text-text/50 hover:text-text" @click="$emit('close')">✕</button>
            </div>

            <Loading v-if="isLoading" />

            <div v-else-if="collages.length === 0" class="text-text/40 text-sm text-center py-4">
                You have no Collages.
            </div>

            <div v-else class="flex flex-col gap-2 max-h-80 overflow-y-auto">
                <div v-for="collage in collages" :key="collage.id"
                    class="flex items-center justify-between px-3 py-2 border cursor-pointer transition-colors"
                    :class="selected === collage.id ? 'border-text bg-text/10' : 'border-text/20 hover:border-text/50'"
                    @click="selected = collage.id">
                    <span class="text-text text-sm">{{ collage.title }}</span>
                    <span class="text-text/40 text-xs">{{ collage.public ? 'Public' : 'Private' }}</span>
                </div>
            </div>

            <BasicButton label="Add" :disabled="!selected" @click="confirm" class="w-full" />
        </div>
    </div>
</template>
