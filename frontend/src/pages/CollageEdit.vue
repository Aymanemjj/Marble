<script setup>
import { onMounted, ref } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import BasicTextArea from '../components/BasicTextArea.vue'
import BasicInput from '../components/BasicInput.vue'
import BasicButton from '../components/BasicButton.vue'
import { useRoute, useRouter } from 'vue-router'
import Loading from '../components/Loading.vue'

const route = useRoute()
const router = useRouter()

const data = ref({
    title: '',
    description: '',
    public: true,
})
const errors = ref({})
const isLoading = ref(true)

onMounted(async () => {
    const res = await useAxiosRequest('get', `/collage/${route.params.id}`, false)
    const collage = res.data.collage
    data.value.title = collage.title
    data.value.description = collage.description
    data.value.public = collage.public
    isLoading.value = false
})

async function submit() {
    await useAxiosRequest('put', `/collage/${route.params.id}/update`, data.value)
    router.push(`/collage/${route.params.id}`)
}
</script>

<template>
    <Loading v-if="isLoading" />
    <main v-else class="grid grid-cols-5 gap-4 min-h-screen">
        <div class="col-span-3 col-start-2 bg-asscent h-fit p-4 self-center mx-4">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submit()">

                <BasicInput :error="errors.title" v-model="data.title" label="Title" name="title" type="text"
                    class="col-span-2" />

                <BasicTextArea :error="errors.description" v-model="data.description" label="Description"
                    name="description" class="col-span-2" />

                <div class="col-span-2 flex items-center gap-3">
                    <span class="text-xs uppercase tracking-widest text-text/60">Visibility</span>
                    <button type="button" class="px-4 py-1 border text-sm transition-colors"
                        :class="data.public ? 'bg-text text-bg border-text' : 'bg-transparent text-text border-text/30'"
                        @click="data.public = !data.public">
                        {{ data.public ? 'Public' : 'Private' }}
                    </button>
                </div>

                <BasicButton label="Save" type="submit" class="col-span-2" />
            </form>
        </div>
    </main>
</template>