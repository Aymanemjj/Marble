<!-- AdminDashboard.vue -->
<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from '../components/Loading.vue'
import AdminSideBar from '../components/AdminSideBar.vue'

const data = ref(null)
const isLoading = computed(() => data.value == null)

onMounted(async () => {
    const res = await useAxiosRequest('get', '/admin/stats', false)
    data.value = res.data
    console.log(data.value);

})

async function ban(id) {
    await useAxiosRequest('patch', `/admin/users/${id}/ban`, false)
    const res = await useAxiosRequest('get', '/admin/stats', false)
    data.value = res.data
}

async function unban(id) {
    await useAxiosRequest('patch', `/admin/users/${id}/unban`, false)
    const res = await useAxiosRequest('get', '/admin/stats', false)
    data.value = res.data
}
</script>

<template>
    <div class="flex">
        <AdminSideBar />
        <Loading class="self-center" v-if="isLoading" />
        <main v-else class=" flex-1 p-8 flex flex-col gap-8">

            <div>
                <h2 class="font-bold text-xs uppercase tracking-widest text-text/40 mb-4">Overview</h2>
                <div class="grid grid-cols-5 gap-4">
                    <div v-for="(value, key) in data.counts" :key="key" class="bg-asscent p-6 flex flex-col gap-2">
                        <span class="text-xs uppercase tracking-widest text-text/40">{{ key }}</span>
                        <span class="font-bold text-4xl text-text">{{ value }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="font-bold text-xs uppercase tracking-widest text-text/40 mb-4">Users</h2>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-text/20">
                            <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">
                                Name</th>
                            <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">
                                Email</th>
                            <th class="text-left py-2 px-3 text-xs uppercase tracking-widest text-text/40 font-normal">
                                Status</th>
                            <th class="py-2 px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data.users" :key="user.id"
                            class="border-b border-text/10 hover:bg-asscent transition-colors">
                            <td class="py-3 px-3 font-bold text-text">
                                {{ [user.firstname, user.middlename !== 'None' ? user.middlename : null,
                                    user.lastname].filter(Boolean).join(' ') }}
                            </td>
                            <td class="py-3 px-3 text-text/60">{{ user.email }}</td>
                            <td class="py-3 px-3">
                                <span class="text-xs uppercase tracking-widest"
                                    :class="user.status === 'banned' ? 'text-red-800' : 'text-text/40'">
                                    {{ user.active ? 'Active' : 'InActive' }}
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <button v-if="user.active"
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-red-800 text-red-800 hover:bg-red-800 hover:text-bg transition-colors cursor-pointer"
                                    @click="ban(user.id)">
                                    Ban
                                </button>
                                <button v-else
                                    class="text-xs uppercase tracking-widest px-3 py-1 border border-text text-text hover:bg-text hover:text-bg transition-colors cursor-pointer"
                                    @click="unban(user.id)">
                                    Unban
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</template>