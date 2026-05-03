<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAxiosRequest } from '../composables/useAxiosRequest'
import Loading from '../components/Loading.vue'
import router from '../router'

const data = ref(null)
const isLoading = computed(() => data.value == null)
const tab = ref('following')

onMounted(async () => {
    const res = await useAxiosRequest('get', '/profile/connections', false)
    data.value = res.data
})
</script>

<template>
    <Loading v-if="isLoading" />
    <main v-else class="grid grid-cols-5 auto-rows-[25vh] gap-4 p-4">

        <!-- Title -->
        <div class="col-span-5 flex items-end justify-between">
            <h2 class="font-bold text-5xl tracking-tight text-text">Connections</h2>
            <div class="flex gap-0">
                <button
                    class="px-6 py-2 text-xs uppercase tracking-widest border border-text transition-colors cursor-pointer"
                    :class="tab === 'following' ? 'bg-text text-bg' : 'bg-transparent text-text'"
                    @click="tab = 'following'">
                    Following
                    <span class="ml-2 opacity-50">{{ data.following.length }}</span>
                </button>
                <button
                    class="px-6 py-2 text-xs uppercase tracking-widest border border-text border-l-0 transition-colors cursor-pointer"
                    :class="tab === 'followers' ? 'bg-text text-bg' : 'bg-transparent text-text'"
                    @click="tab = 'followers'">
                    Followers
                    <span class="ml-2 opacity-50">{{ data.followers.length }}</span>
                </button>
            </div>
        </div>

        <!-- List -->
        <div class="col-span-5 row-span-4 flex flex-col gap-0">
            <div v-if="tab === 'following' && data.following.length === 0"
                class="text-text/30 text-sm uppercase tracking-widest mt-8">
                Not following anyone yet.
            </div>
            <div v-if="tab === 'followers' && data.followers.length === 0"
                class="text-text/30 text-sm uppercase tracking-widest mt-8">
                No followers yet.
            </div>

            <div v-for="creator in tab === 'following' ? data.following : data.followers" :key="creator.id"
                class="flex items-center justify-between px-4 py-3 border-b border-text/10 hover:bg-asscent transition-colors cursor-pointer group"
                @click="router.push(`/creator/${creator.administered ? 'artist' : 'user'}/${creator.id}`)">

                <div class="flex items-center gap-4">
                    <img :src="creator.profile.picture" class="w-10 h-10 object-cover" />
                    <div class="flex flex-col">
                        <span class="font-bold text-text text-sm uppercase tracking-wide">
                            {{ [creator.firstname, creator.middlename !== 'None' ? creator.middlename : null,
                            creator.lastname].filter(Boolean).join(' ') }}
                        </span>
                        <span class="text-text/40 text-xs uppercase tracking-widest">
                            {{ creator.administered ? 'Artist' : 'User' }}
                        </span>
                    </div>
                </div>

                <span class="text-text/20 group-hover:text-text/60 text-xs uppercase tracking-widest transition-colors">
                    View →
                </span>
            </div>
        </div>

    </main>
</template>