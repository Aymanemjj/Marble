<script setup>
import CollageCover from "../components/CollageCover.vue";
import DisplayException from "../components/DisplayException.vue";
import Loading from "../components/Loading.vue";
import PieceCover from "../components/PieceCover.vue";
import { useGallery } from "../composables/useGallery";


const { GALLERY, isLoading, selectedTab, hasNoPieces, hasNoCollages } = useGallery();


</script>

<template>

    <Loading v-if="isLoading" />

    <main v-else class="flex flex-col gap-4">

        <div class="flex divide-x divide-solid divide-text">
            <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
                :class="selectedTab == 'Pieces' ? 'border-b' : ''" @click="selectedTab = 'Pieces'">
                Pieces
            </button>
            <button class="w-full font-bold text-2xl hover:underline cursor-pointer"
                :class="selectedTab == 'Collages' ? 'border-b' : ''" @click="selectedTab = 'Collages'">
                Collages
            </button>
        </div>

        <div v-if="selectedTab == 'Pieces'">
            <DisplayException v-if="hasNoPieces" :message="'Creator has no Pieces'" :img="'NoPieces'" />
            <div v-else class="columns-5 gap-4">
                <div v-for="piece in GALLERY.pieces" class="">
                    <PieceCover :piece="piece" />
                </div>
            </div>
        </div>
        <div v-else>
            <DisplayException v-if="hasNoCollages" :message="'Creator has no public Collages'" :img="'NoCollages'" />
            <div class="grid grid-cols-5 gap-4 auto-rows-[25vh]">
                <CollageCover v-for="collage in GALLERY.collages" :key="collage.id" :collage="collage" />
            </div>
        </div>
    </main>

</template>