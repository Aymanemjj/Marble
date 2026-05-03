<script setup>
import { ref, reactive } from 'vue'
import { useAuthStore } from '../stores/useAuthStore'
import BasicTextArea from '../components/BasicTextArea.vue'
import BasicButton from '../components/BasicButton.vue'
import Loading from '../components/Loading.vue'
import { useProfileEdit } from '../composables/useProfileEdit'

const { data, previews, errors, onFile, submit, pieces, isLoading } = useProfileEdit()

</script>


<template>
    <Loading v-if="isLoading" />
    <main v-else class="grid grid-cols-5 gap-4 min-h-screen">

        <!-- Form -->
        <div class="col-span-3 col-start-2 bg-asscent h-fit p-4 self-center mx-4">
            <form class="self-center grid grid-cols-2 gap-4" @submit.prevent="submit()">

                <!-- Picture -->
                <div class="col-span-1 flex flex-col gap-1">
                    <label class="text-xs uppercase tracking-widest text-text/60">Picture</label>
                    <div class="relative group w-full aspect-square bg-bg border border-text/20 overflow-hidden cursor-pointer"
                        @click="$refs.pictureInput.click()">
                        <img v-if="previews.picture" :src="previews.picture" class="w-full h-full object-cover" />
                        <div v-else class="w-full h-full flex items-center justify-center text-text/30 text-xs">No image
                        </div>
                        <div
                            class="absolute inset-0 bg-bg/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-text text-xs uppercase tracking-widest">
                            Change
                        </div>
                    </div>
                    <input ref="pictureInput" type="file" accept="image/*" class="hidden"
                        @change="onFile('picture', $event)" />
                    <span v-if="errors.picture" class="text-red-400 text-xs">{{ errors.picture }}</span>
                </div>

                <!-- Banner -->
                <div class="col-span-1 flex flex-col gap-1">
                    <label class="text-xs uppercase tracking-widest text-text/60">Banner</label>
                    <div class="relative group w-full aspect-square bg-bg border border-text/20 overflow-hidden cursor-pointer"
                        @click="$refs.bannerInput.click()">
                        <img v-if="previews.banner" :src="previews.banner" class="w-full h-full object-cover" />
                        <div v-else class="w-full h-full flex items-center justify-center text-text/30 text-xs">No image
                        </div>
                        <div
                            class="absolute inset-0 bg-bg/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-text text-xs uppercase tracking-widest">
                            Change
                        </div>
                    </div>
                    <input ref="bannerInput" type="file" accept="image/*" class="hidden"
                        @change="onFile('banner', $event)" />
                    <span v-if="errors.banner" class="text-red-400 text-xs">{{ errors.banner }}</span>
                </div>

                <!-- Biography -->
                <BasicTextArea :error="errors.biography" v-model="data.biography" label="Biography" name="biography"
                    class="col-span-2" />

                <!-- Fav Pieces -->
                <div class="col-span-1 flex flex-col gap-1">
                    <label class="text-xs uppercase tracking-widest text-text/60">Fav Piece 1</label>
                    <select v-model="data.fav_piece_id_1"
                        class="bg-bg border border-text/20 text-text px-3 py-2 text-sm w-full">
                        <option :value="null">— None —</option>
                        <option v-for="piece in pieces" :key="piece.id" :value="piece.id">{{ piece.title }}</option>
                    </select>
                    <span v-if="errors.fav_piece_id_1" class="text-red-400 text-xs">{{ errors.fav_piece_id_1 }}</span>
                </div>

                <div class="col-span-1 flex flex-col gap-1">
                    <label class="text-xs uppercase tracking-widest text-text/60">Fav Piece 2</label>
                    <select v-model="data.fav_piece_id_2"
                        class="bg-bg border border-text/20 text-text px-3 py-2 text-sm w-full">
                        <option :value="null">— None —</option>
                        <option v-for="piece in pieces" :key="piece.id" :value="piece.id">{{ piece.title }}</option>
                    </select>
                    <span v-if="errors.fav_piece_id_2" class="text-red-400 text-xs">{{ errors.fav_piece_id_2 }}</span>
                </div>

                <BasicButton label="Save" type="submit" class="col-span-2" />
            </form>
        </div>

    </main>
</template>
