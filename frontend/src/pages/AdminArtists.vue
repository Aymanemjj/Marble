<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from '../components/Loading.vue'
import router from '../router'
import AdminSideBar from '../components/AdminSideBar.vue'

const artists = ref(null)
const isLoading = computed(() => artists.value == null)
const form = ref({ 
    firstname: '', 
    middlename: '', 
    lastname: '', 
    date_of_birth: '', 
    main_medium: '', 
    biography: '' })

onMounted(async () => refresh())

async function create() {
    await useAxiosRequest('post', '/admin/artist/create', form.value)
    form.value = { firstname: '', middlename: '', lastname: '', date_of_birth: '', main_medium: '', biography: '' }
    showForm.value = false
    refresh()
}

async function remove(id) {
    await useAxiosRequest('delete', `/admin/artist/${id}/delete`, false)
    refresh()
}

async function refresh() {
    const res = await useAxiosRequest('get', '/artists', false)
    artists.value = res.data.artists
}
</script>

<template>

    <Loading v-if="isLoading" />
    <div v-else class="flex">
        <AdminSideBar />
        <main class="w-full p-8 flex flex-col gap-8">

            <div class="flex items-end justify-between">
                <h1 class="font-bold text-5xl tracking-tight text-text uppercase">Artists</h1>
                <button @click="router.push('/administration/artists/create')"
                    class="px-6 py-2 bg-text text-bg text-xs uppercase tracking-widest hover:bg-bg hover:text-text border border-text transition-colors cursor-pointer">
                    New Artist
                </button>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-text/20">
                        <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">Name
                        </th>
                        <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">
                            Medium
                        </th>
                        <th class="py-2 px-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="artist in artists" :key="artist.id"
                        class="border-b border-text/10 hover:bg-asscent transition-colors">
                        <td class="py-3 px-3 font-bold text-text uppercase tracking-wide">
                            {{ [artist.firstname, artist.middlename, artist.lastname].filter(Boolean).join(' ') }}
                        </td>
                        <td class="py-3 px-3 text-text/50 text-xs uppercase tracking-widest">
                            {{ artist.main_medium ?? '—' }}
                        </td>
                        <td class="py-3 px-3 text-right flex gap-2 justify-end">
                            <button @click="router.push(`/creator/artist/${artist.id}`)"
                                class="text-xs uppercase tracking-widest px-3 py-1 border border-text text-text hover:bg-text hover:text-bg transition-colors cursor-pointer">
                                View
                            </button>
                            <button @click="router.push(`/administration/artists/${artist.id}/edit`)"
                                class="text-xs uppercase tracking-widest px-3 py-1 border border-text text-text hover:bg-text hover:text-bg transition-colors cursor-pointer">
                                Edit
                            </button>
                            <button @click="remove(artist.id)"
                                class="text-xs uppercase tracking-widest px-3 py-1 border border-red-800 text-red-800 hover:bg-red-800 hover:text-bg transition-colors cursor-pointer">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </main>
    </div>
</template>