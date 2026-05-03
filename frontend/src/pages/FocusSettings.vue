<script setup>
import { ref } from 'vue';
import Loading from '../components/Loading.vue';
import { useFocusSettings } from '../composables/useFocusSettings';
import SelecteTags from '../components/SelecteTags.vue';
import DisplayException from '../components/DisplayException.vue';

const { data, submit, errors } = useFocusSettings()
</script>

<template>
    <div v-if="errors.noPieces" class="flex flex-col gap-4 items-center">
        <DisplayException :message="'No Pieces availabel with the tags you selected'" :img="'NoPieces'" />

        <button class="text-text font-bold hover:underline text-md" @click="errors.noPieces = false">Go Back to Settings?
        </button>
    </div>
    <main v-else class="min-h-screen grid grid-cols-5 auto-rows-[25vh] gap-4 p-6">

        <div class="col-span-5 flex items-end">
            <div class="flex items-baseline gap-4">
                <h2 class="font-bold text-5xl tracking-tight text-text">Settings</h2>
                <span class="text-text/30 text-sm uppercase tracking-[0.3em]">Focus Session</span>
            </div>
        </div>

        <div
            class="row-start-2 row-span-2 col-start-1 col-span-2 bg-asscent flex flex-col justify-between p-6 border border-text/10">

            <div>
                <p class="text-xs uppercase tracking-widest text-text/40 mb-3">Duration</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-7xl text-text tabular-nums leading-none">
                        {{ data.minutes < 10 ? `0${data.minutes}` : data.minutes }} </span>
                            <span class="font-bold text-4xl text-text/30 mx-1 leading-none">:</span>
                            <span class="font-bold text-7xl text-text tabular-nums leading-none">
                                {{ data.seconds < 10 ? `0${data.seconds}` : data.seconds }} </span>
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between text-xs uppercase tracking-widest">
                        <label class="text-text/50">Minutes</label>
                        <span class="text-text">{{ data.minutes }}</span>
                    </div>
                    <input class="w-full appearance-none bg-text/20 h-px cursor-pointer
                                  [&::-webkit-slider-thumb]:appearance-none
                                  [&::-webkit-slider-thumb]:w-3
                                  [&::-webkit-slider-thumb]:h-3
                                  [&::-webkit-slider-thumb]:bg-text
                                  [&::-webkit-slider-thumb]:rounded-none" type="range" min="1" max="60"
                        v-model="data.minutes" step="1" />
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between text-xs uppercase tracking-widest">
                        <label class="text-text/50">Seconds</label>
                        <span class="text-text">{{ data.seconds }}</span>
                    </div>
                    <input class="w-full appearance-none bg-text/20 h-px cursor-pointer
                                  [&::-webkit-slider-thumb]:appearance-none
                                  [&::-webkit-slider-thumb]:w-3
                                  [&::-webkit-slider-thumb]:h-3
                                  [&::-webkit-slider-thumb]:bg-text
                                  [&::-webkit-slider-thumb]:rounded-none" type="range" min="0" max="59"
                        v-model="data.seconds" step="1" />
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button
                    class="w-full py-3 bg-text text-bg text-xs uppercase tracking-widest hover:bg-bg hover:text-text border border-text transition-colors cursor-pointer"
                    @click="submit()">
                    Start Session
                </button>
                <p class="text-text/30 text-xs leading-relaxed">
                    Timer settings lock on start. Restart to reconfigure.
                </p>
            </div>
        </div>

        <div
            class="row-start-2 row-span-2 col-start-3 col-span-3 bg-asscent flex flex-col gap-6 p-6 border border-text/10">
            <div>
                <p class="text-xs uppercase tracking-widest text-text/40 mb-1">Focus Tags</p>
                <h3 class="font-bold text-2xl text-text">Pick up to 5</h3>
            </div>

            <div class="w-full flex items-start flex-wrap gap-2">
                <SelecteTags :selectedTags="data.tags" v-model="data.tags" />
            </div>

        </div>

    </main>
</template>