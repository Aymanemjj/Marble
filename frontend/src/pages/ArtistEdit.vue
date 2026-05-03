<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import { useRoute } from 'vue-router'
import Loading from '../components/Loading.vue'
import router from '../router'

const route = useRoute()
const form = ref(null)
const isLoading = computed(() => form.value == null)
const errors = ref({})

onMounted(async () => {
    const res = await useAxiosRequest('get', `/creator/artist/${route.params.id}`, false)
    const a = res.data
    form.value = {
        firstname: a.firstname, middlename: a.middlename !== 'None' ? a.middlename : '',
        lastname: a.lastname, date_of_birth: a.date_of_birth, date_of_death: a.date_of_death !== 'Still alive' ? a.date_of_death : '',
        main_medium: a.main_medium !== 'None' ? a.main_medium : '', biography: a.profile.biography !== 'None provided' ? a.profile.biography : '',
    }
})

function onFile(field, e) {
    form.value[field] = e.target.files[0]
}

async function submit() {
    const data = new FormData()
    data.append('_method', 'PATCH')
    Object.entries(form.value).forEach(([key, val]) => { if (val) data.append(key, val) })
    const res = await useAxiosRequest('post', `/admin/artist/${route.params.id}/update`, data)
    if (res.success) router.push('/administration/artists')
    else errors.value = res.errors ?? {}
}
</script>

<template>
    <Loading v-if="isLoading" />
    <main v-else class="p-8 flex flex-col gap-8">
        <h1 class="font-bold text-5xl tracking-tight text-text uppercase">Edit Artist</h1>

        <form class="bg-asscent p-6 grid grid-cols-2 gap-4" @submit.prevent="submit">

            <div v-for="field in ['firstname', 'middlename', 'lastname', 'main_medium']" :key="field"
                class="flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">{{ field.replace('_', ' ') }}</label>
                <input v-model="form[field]" type="text"
                    class="bg-bg border border-text/20 text-text px-3 py-2 text-sm focus:outline-none focus:border-text" />
                <span v-if="errors[field]" class="text-red-400 text-xs">{{ errors[field][0] }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">Date of Birth</label>
                <input v-model="form.date_of_birth" type="date"
                    class="bg-bg border border-text/20 text-text px-3 py-2 text-sm focus:outline-none focus:border-text" />
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">Date of Death</label>
                <input v-model="form.date_of_death" type="date"
                    class="bg-bg border border-text/20 text-text px-3 py-2 text-sm focus:outline-none focus:border-text" />
            </div>

            <div class="col-span-2 flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">Biography</label>
                <textarea v-model="form.biography" rows="4"
                    class="bg-bg border border-text/20 text-text px-3 py-2 text-sm focus:outline-none focus:border-text resize-none" />
                <span v-if="errors.biography" class="text-red-400 text-xs">{{ errors.biography[0] }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">Picture</label>
                <input type="file" accept="image/*" @change="onFile('picture', $event)" class="text-text text-sm" />
                <span v-if="errors.picture" class="text-red-400 text-xs">{{ errors.picture[0] }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs uppercase tracking-widest text-text/40">Banner</label>
                <input type="file" accept="image/*" @change="onFile('banner', $event)" class="text-text text-sm" />
                <span v-if="errors.banner" class="text-red-400 text-xs">{{ errors.banner[0] }}</span>
            </div>

            <button type="submit"
                class="col-span-2 py-2 bg-text text-bg text-xs uppercase tracking-widest hover:bg-bg hover:text-text border border-text transition-colors cursor-pointer">
                Save Changes
            </button>
        </form>
    </main>
</template>