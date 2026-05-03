<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from '../components/Loading.vue'
import BasicButton from '../components/BasicButton.vue'
import PieceCard from '../components/PieceCard.vue'

const route = useRoute()
const collage = ref(null)
const isLoading = computed(() => collage.value == null);

onMounted(async () => {
    const res = await useAxiosRequest('get', `/collage/${route.params.id}`, false)
    collage.value = res.data.collage
})

</script>



<template>
    <Loading v-if="isLoading" />
    <main v-else class="min-h-screen">

        <div class="bg-asscent p-4 mx-4 mt-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl font-bold text-text">{{ collage.title }}</h1>
                    <span class="text-xs uppercase tracking-widest text-text/50">
                        {{ collage.public ? 'Public' : 'Private' }}
                    </span>
                </div>
                <p v-if="collage.description" class="text-sm text-text/70 max-w-md">{{ collage.description }}</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-sm text-text/60">
                    <span>By</span>
                    <span class="text-text font-medium">{{ collage.creator.firstname }} {{ collage.creator.lastname
                    }}</span>
                </div>
                <BasicButton v-if="collage.administered" label="Edit"
                    @click="$router.push(`/collages/${collage.id}/edit`)" />
            </div>
        </div>

        <div class="p-4">
            <div class="columns-5 gap-4">
                <div v-for="piece in collage.pieces" :key="piece.id">
                    <PieceCard :image="piece" />
                </div>
            </div>
        </div>

    </main>
</template>
