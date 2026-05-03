<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from '../components/Loading.vue'
import AdminSideBar from '../components/AdminSideBar.vue'

const tags = ref(null)
const isLoading = computed(() => tags.value == null)
const form = ref({ name: '' })
const editing = ref(null)

onMounted(async () => {
    const res = await useAxiosRequest('get', '/tags/list', false)
    tags.value = res.data.tags
})

async function create() {
    await useAxiosRequest('post', '/admin/tags/create', form.value)
    form.value.name = ''
    refresh()
}

async function update() {
    await useAxiosRequest('patch', `/admin/tags/${editing.value.id}/update`, { name: editing.value.name })
    editing.value = null
    refresh()
}

async function remove(id) {
    await useAxiosRequest('delete', `/admin/tags/${id}/delete`, false)
    refresh()
}

async function refresh() {
    const res = await useAxiosRequest('get', '/tags', false)
    tags.value = res.data.tags
}
</script>

<template>
    <Loading v-if="isLoading" />

    <div v-else class="flex">
        <AdminSideBar />

        <main class="w-full p-8 flex flex-col gap-8">

            <h1 class="font-bold text-5xl tracking-tight text-text uppercase">Tags</h1>

            <div class="bg-asscent p-6 flex gap-4 items-end">
                <div class="flex flex-col gap-1 flex-1">
                    <label class="text-xs uppercase tracking-widest text-text/40">New Tag</label>
                    <input v-model="form.name" type="text"
                        class="bg-bg border border-text/20 text-text px-3 py-2 text-sm w-full focus:outline-none focus:border-text"
                        placeholder="Tag name" />
                </div>
                <button @click="create"
                    class="px-6 py-2 bg-text text-bg text-xs uppercase tracking-widest hover:bg-bg hover:text-text border border-text transition-colors cursor-pointer">
                    Create
                </button>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-text/20">
                        <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">Name
                        </th>
                        <th class="py-2 px-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags" :key="tag.id"
                        class="border-b border-text/10 hover:bg-asscent transition-colors">
                        <td class="py-3 px-3">
                            <input v-if="editing?.id === tag.id" v-model="editing.name"
                                class="bg-bg border border-text/20 text-text px-2 py-1 text-sm focus:outline-none focus:border-text" />
                            <span v-else class="font-bold text-text uppercase tracking-wide">{{ tag.name }}</span>
                        </td>
                        <td class="py-3 px-3 text-right flex gap-2 justify-end">
                            <template v-if="editing?.id === tag.id">
                                <button @click="update"
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-text text-text hover:bg-text hover:text-bg transition-colors cursor-pointer">
                                    Save
                                </button>
                                <button @click="editing = null"
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-text/30 text-text/40 hover:border-text hover:text-text transition-colors cursor-pointer">
                                    Cancel
                                </button>
                            </template>
                            <template v-else>
                                <button @click="editing = { ...tag }"
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-text text-text hover:bg-text hover:text-bg transition-colors cursor-pointer">
                                    Edit
                                </button>
                                <button @click="remove(tag.id)"
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-red-800 text-red-800 hover:bg-red-800 hover:text-bg transition-colors cursor-pointer">
                                    Delete
                                </button>
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>

        </main>
    </div>
</template>