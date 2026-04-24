<script setup>
import BasicInput from '../components/BasicInput.vue';
import authBg from '../assets/authenticationBG.jpg'
import BasicButton from '../components/BasicButton.vue';
import { ref } from 'vue';
import { authintify } from '../services/auth';



const data = ref({
  email: '',
  password: '',

})



</script>

<template>
  <main :style="{ backgroundImage: `url(${authBg})` }"
    class="bg-cover bg-center bg-no-repeat grid grid-cols-5 gap-4 min-h-screen">
    <div class="col-span-2 bg-bg h-fit p-4 self-center mx-4">
      <form class="grid grid-cols-2 gap-4" @submit.prevent="authintify(data, 'login')">
        <BasicInput v-model="data.email" label="Email" name="email" type="email" class="col-span-2" />
        <BasicInput v-model="data.password" label="Password" name="password" type="password" class="col-span-2" />
        <BasicButton label="Login" type="submit" class="col-span-2" />
      </form>
      <RouterLink to="/register" class="text-text font-bold hover:underline text-md">Don't have an account?</RouterLink>
    </div>
  </main>
</template>