<script setup>
import BasicInput from '../components/BasicInput.vue';
import authBg from '../assets/authenticationBG.jpg'
import BasicButton from '../components/BasicButton.vue';
import { authintify } from '../services/auth.js';
import { ref } from 'vue';

const errors = ref({})
const data = ref({
    firstname: '',
    middlename: '',
    lastname: '',
    date_of_birth: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = async () => {
    errors.value = await authintify(data.value, 'register') ?? {};
}
</script>

<template>
    <main :style="{ backgroundImage: `url(${authBg})` }"
        class="bg-cover bg-center bg-no-repeat grid grid-cols-5 gap-4 min-h-screen">
        <div class="col-span-2 bg-bg h-fit p-4 self-center mx-4">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submit">
                <BasicInput :error="errors.firstname" label="Firstname" v-model="data.firstname" name="firstname"
                    type="text" />
                <BasicInput :error="errors.lastname" label="Lastname" v-model="data.lastname" name="lastname"
                    type="text" />
                <BasicInput :error="errors.middlename" label="Middlename" v-model="data.middlename" name="middlename"
                    type="text" />
                <BasicInput :error="errors.date_of_birth" label="Date of birth" v-model="data.date_of_birth"
                    name="date_of_birth" type="date" />
                <BasicInput :error="errors.email" label="Email" v-model="data.email" name="email" type="email"
                    class="col-span-2" />
                <BasicInput :error="errors.password" label="Password" v-model="data.password" name="password"
                    type="password" />
                <BasicInput :error="errors.password_confirmation" label="Confirm password"
                    v-model="data.password_confirmation" name="password_confirmation" type="password" />
                <BasicButton label="Register" type="submit" class="col-span-2" />
            </form>
            <RouterLink to="/login" class="text-text font-bold hover:underline text-md">Already have an account?
            </RouterLink>
        </div>
    </main>
</template>