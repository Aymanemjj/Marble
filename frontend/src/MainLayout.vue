<script setup>
import { RouterView } from 'vue-router';
import { signOut } from './services/auth';
import BasicInput from './components/BasicInput.vue';
import { computed, ref } from 'vue';
import router from './router';
import { search } from './services/PieceService';

let Auth = JSON.parse(localStorage.getItem('user'))
//SubMenus Stat
const open = ref(false)
const searchBar = ref(false)

//Search inputs
const filters = ref({
    search : null,
    tags : null
})

function filter(){
    
    router.push({
        name:'Home',
        query: {
            search : filters.value.search,
            tags: filters.value.tags
        }
    })
}

</script>

<template>

    <nav class="mb-8 sticky top-0 z-50 bg-bg">
        <div>
            <ul class="grid grid-cols-5 gap-4 items-center text-center font-bold text-2xl overflow-visible z-50">
                <RouterLink to="/"
                    class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">
                    Marble</RouterLink>
                <RouterLink to="/focus/settings" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>


                <button class="cursor-pointer hover:underline z-50 relative h-full" @click="searchBar = true"
                    @mouseleave="searchBar = false">

                    Search
                    <div class="absolute top-full right-0 border border-0.5 border-text text-center w-full  origin-top duration-200 bg-bg"
                        :class="searchBar ? 'scal-y-100' : 'scale-y-0'">
                        <form @submit.prevent="search(filters)" class="p-2 flex flex-col gap-2">
                            <input type="search" name="search" id="search" class="bg-asscent p-2"
                                placeholder="Search ..." v-model="filters.search">
                            <div class="text-left">
                                <label for="tags">Tags :</label>
                                <select name="tags" id="tags" class="bg-asscent w-full p-2" v-model="filters.tags">
                                    <option value=""></option>
                                    <option value="Oil Painting">Oil Painting</option>
                                    <option value="Watercolor">Watercolor</option>
                                </select>
                            </div>
                            <div class="flex gap-2 w-full">
                                <button type="submit" class="border border-text hover:bg-text hover:text-bg w-full cursor-pointer">Filter</button>
                                <input type="reset" class="border border-text hover:bg-text hover:text-bg w-full cursor-pointer">
                            </div>
                        </form>
                    </div>
                </button>


                <RouterLink v-if="!Auth" to="/register"
                    class="border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:bg-text hover:text-bg">
                    JoinUs</RouterLink>


                <button v-else @mouseenter="open = true" @mouseleave="open = false"
                    class="z-50 relative border border-0.5 border-text px-1.25 py-5 text-center cursor-pointer hover:underline">
                    You
                    <div class="absolute top-full right-0 border border-0.5 border-text text-center w-full  origin-top duration-200"
                        :class="open ? 'scal-y-100' : 'scale-y-0'">
                        <ul>
                            <li class="hover:bg-text hover:text-bg bg-bg px-1.25 py-5">
                                <RouterLink to="/profile">Profile</RouterLink>
                            </li>

                            <li class="hover:bg-text bg-bg hover:text-bg px-1.25 py-5">
                                <RouterLink to="/settings">Settings</RouterLink>
                            </li>

                            <li class="hover:bg-red-800 bg-bg hover:text-bg px-1.25 py-5"><button
                                    @click="signOut()">LogOut</button></li>
                        </ul>
                    </div>
                </button>
            </ul>
        </div>
    </nav>

    <RouterView />

    <footer class="bg-text grid grid-cols-5 grid-rows-4 gap-4 text-bg mt-8">

        <div class="col-start-4 col-span-2">
            <form action="" class="grid grid-cols-2 ">
                <BasicInput label="" name="email" type="text" />
                <button type="submit"
                    class="cursor-pointer text-2xl font-extrabold border border-bg hover:bg-bg hover:text-text">Subscribe</button>
            </form>
        </div>

        <div class="row-start-2">
            <ul class="flex flex-col font-extrabold text-3xl">
                <RouterLink to="/" class="cursor-pointer hover:underline">
                    Marble</RouterLink>
                <RouterLink to="/focus" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>
                <RouterLink to="/about" class="cursor-pointer hover:underline">About</RouterLink>
            </ul>
        </div>

        <div class="row-start-2 col-start-2">
            <ul class="flex flex-col font-extrabold text-3xl">
                <RouterLink to="/policies/privacy" class="cursor-pointer hover:underline">
                    Privacy Policies</RouterLink>
                <RouterLink to="/focus" class="cursor-pointer hover:underline">Focus</RouterLink>
                <RouterLink to="/artists" class="cursor-pointer hover:underline">Artists</RouterLink>
                <RouterLink to="/about" class="cursor-pointer hover:underline">About</RouterLink>
            </ul>
        </div>

        <div class="row-start-3 row-span-2 col-span-5 text-center pb-0">
            <h2 class="text-[20vw] font-extrabold w-full leading-none mb-0">
                MARBLE
            </h2>
        </div>
    </footer>
</template>