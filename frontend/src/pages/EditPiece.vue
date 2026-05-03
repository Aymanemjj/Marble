<script setup>
import BasicInput from '../components/BasicInput.vue';
import BasicButton from '../components/BasicButton.vue';
import BasicTextArea from '../components/BasicTextArea.vue';
import SelecteTags from '../components/SelecteTags.vue';
import { usePieceEdit } from '../composables/usePieceEdit';
import Loading from '../components/Loading.vue';

const { data, errors, submit, PIECE, isLoading } = usePieceEdit()

</script>

<template>

    <Loading v-if="isLoading" />

    <main v-else class=" grid grid-cols-5 gap-4 min-h-screen">
        <div class="col-span-2 bg-asscent h-fit p-4 self-center mx-4">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submit()">
                <BasicInput :error="errors.title" v-model="data.title" label="Title" name="title" type="text"
                    class="col-span-2" />
                <BasicTextArea :error="errors.story" v-model="data.story" label="story" name="story" type="story"
                    class="col-span-2" />
                <BasicInput :error="errors.date" v-model="data.date" label="Date" name="date" type="date"
                    class="col-span-2" />

                <SelecteTags :selectedTags="data.tags" v-model="data.tags" />
                <BasicButton label="Upload" type="submit" class="col-span-2" />
            </form>
        </div>

        <div class="col-span-3 scale-75">
            <div class="bg-text w-full h-screen flex items-center align-middle">
                <img :src="PIECE.path" class="w-full object-contain max-h-full" />
            </div>
        </div>
    </main>
</template>