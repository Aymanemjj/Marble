<script setup>
import BasicInput from '../components/BasicInput.vue';
import BasicButton from '../components/BasicButton.vue';
import BasicTextArea from '../components/BasicTextArea.vue';
import SelecteTags from '../components/SelecteTags.vue';
import { usePieceCreate } from '../composables/usePieceCreate';

const { data, errors, submit, artists, auth } = usePieceCreate()



</script>

<template>
    <main class="bg-cover bg-center bg-no-repeat grid grid-cols-5 gap-4 min-h-screen">

        <div class="col-span-2 bg-asscent h-fit p-4 self-center mx-4">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submit()">
                <BasicInput :error="errors.title" v-model="data.title" label="Title" name="title" type="text"
                    class="col-span-2" />
                <BasicTextArea :error="errors.story" v-model="data.story" label="story" name="story" type="story"
                    class="col-span-2" />
                <BasicInput :error="errors.date" v-model="data.date" label="Date" name="date" type="date"
                    class="col-span-2" />
                <BasicInput :error="errors.path" label="Image" name="path" type="file" class="col-span-2"
                    @change="e => data.path = e.target.files[0]" />
                <div class="flex flex-col">
                    <label for="artist">Artist :</label>
                    <select v-if="auth.isAdmin" name="artist" id="artist" class="bg-bg border border-text w-full p-2"
                        v-model="data.artist">
                        <option :value="null"></option>
                        <option v-for="artist in artists" :value="artist.id">{{ artist.firstname + " " +
                            artist.lastname}}</option>

                    </select>
                    <span v-if="errors.artist" class="text-red-800 text-sm font-bold">
                        {{ errors.artist[0] }}
                    </span>
                </div>
                <SelecteTags v-model="data.tags" />
                <BasicButton label="Upload" type="submit" class="col-span-2" />
            </form>
        </div>
    </main>
</template>