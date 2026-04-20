<script setup>
import { computed, onMounted, ref } from 'vue';
import BasicInput from '../components/BasicInput.vue';
import router from '../router';
import axiosClient from '../axios';
import Loading from '../components/Loading.vue';
import SelectableTag from '../components/SelectableTag.vue';

const MINUTES = ref(1)
const SECONDS = ref(0)
const TAGS = [
    "Design", "Engineering", "Product", "Marketing", "Research", "Data", "Security", "Infrastructure",
    "Critical", "High", "Medium", "Low", "Backlog",
    "In progress", "Needs review", "Blocked", "Done", "Archived",
    "Frontend", "Backend", "Mobile", "DevOps", "QA", "Design Ops"
];

/* const isLoading = computed(() => TAGS.value == null);

onMounted(async () => {
    TAGS.value = (await axiosClient.get('/focus/config/')).data.data;
}) */
</script>

<template>

    <Loading v-if="isLoading" />

    <main v-else class="grid grid-cols-5 auto-rows-[25vh] gap-4">
        <div class="col-start-3 flex items-end justify-center">
            <h2 class="font-bold text-3xl">Settings</h2>
        </div>

        <div
            class="row-start-2 row-span-2 col-start-2 col-span-3 border border-text border-0.5 grid grid-cols-5 p-2 gap-2 bg-asscent">
            <div class="col-span-2 flex flex-col p-4 justify-between">
                <div class="flex flex-col">
                    <h3 class="font-bold text-2xl">Pomodoro timer length</h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex bg-text text-bg w-32 px-4 py-2 font-bold text-3xl justify-between">
                            <h3>{{ MINUTES < 10 ? `0${MINUTES}` : MINUTES }}</h3>
                                    <h3>:</h3>
                                    <h3>{{ SECONDS < 10 ? `0${SECONDS}` : SECONDS }}</h3>
                        </div>
                        <form>
                            <label for="minutes-slider">Minutes</label>
                            <input class="w-full appearance-none bg-text h-1" type="range" name="minutes-slider"
                                id="minutes-slider" min="1" max="60" v-model="MINUTES" step="1">
                            <label for="seconds-slider">Seconds</label>
                            <input class="w-full appearance-none bg-text h-1" type="range" name="seconds-slider"
                                id="seconds-slider" min="0" max="59" v-model="SECONDS" step="1">
                            <button type="submit"
                                class="bg-text hover:bg-bg text-bg hover:text-text px-2 cursor-pointer w-full border border-text">Start</button>
                        </form>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-2xl">Caution!</h3>
                    <p>These settings are not changable after you start, you have to fully restart.</p>
                </div>
            </div>
            <div class="col-span-3 border border-text flex flex-col gap-4 p-4">

                <h3 class="font-bold text-2xl">
                    Pick up to 5 tags
                </h3>

                <div class="w-full h-fit flex items-center flex-wrap gap-4 ">
                    <SelectableTag v-for="tag in TAGS" :label="tag" />
                </div>
            </div>
        </div>
        <div class="row-start-4"></div>
    </main>
</template>
