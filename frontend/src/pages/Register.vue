<script setup>
import BasicInput from '../components/BasicInput.vue';
import authBg from '../assets/authenticationBG.jpg'
import BasicButton from '../components/BasicButton.vue';
import axiosClient from '../axios.js';
import { ref } from 'vue';
import { signIn, signOut } from '../auth.js';
import router from '../router.js';


const data = ref({
    firstname: '',
    middlename: '',
    lastname: '',
    date_of_birth: '',
    email: '',
    password: '',
    password_confirmation: '',

})

async function submit() {
    try {
        const res = await axiosClient.post('/register', data.value);
        signIn(res.data.user);
        router.push('/');
    } catch (err) {
        console.log(err.res.data)
    }
}

</script>

<template>
    <main :style="{ backgroundImage: `url(${authBg})` }"
        class="bg-cover bg-center bg-no-repeat grid grid-cols-5 gap-4 min-h-screen">
        <div class="col-span-2 bg-bg h-fit p-4">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submit">
                <BasicInput label="Firstname" v-model="data.firstname" name="firstname" type="text" />
                <BasicInput label="Lastname" v-model="data.lastname" name="lastname" type="text" />
                <BasicInput label="Middlename" v-model="data.middlename" name="middlename" type="text" />
                <BasicInput label="Date of birth" v-model="data.date_of_birth" name="date_of_birth" type="date" />
                <BasicInput label="Email" v-model="data.email" name="email" type="email" class="col-span-2" />
                <BasicInput label="Password" v-model="data.password" name="password" type="password" />
                <BasicInput label="Confirm password" v-model="data.password_confirmation" name="password_confirmation"
                    type="password" />
                <BasicButton label="Register" type="submit" class="col-span-2" />
            </form>
            <RouterLink to="/login" class="text-text font-bold hover:underline text-md">Already have an account?
            </RouterLink>
        </div>
    </main>
</template>