<script setup>
import BasicInput from '../components/BasicInput.vue';
import authBg from '../assets/authenticationBG.jpg'
import BasicButton from '../components/BasicButton.vue';
</script>

<template>
  <main :style="{ backgroundImage: `url(${authBg})` }"
    class="bg-cover bg-center bg-no-repeat grid grid-cols-5 gap-4 min-h-screen">
    <div class="col-span-2 bg-bg h-fit p-4">
      <form class="grid grid-cols-2 gap-4">
        <BasicInput label="Email" name="email" type="email" class="col-span-2" />
        <BasicInput label="Password" name="password" type="password" class="col-span-2" />
        <BasicButton label="Login" type="submit" class="col-span-2" />
      </form>
      <RouterLink to="/register" class="text-text font-bold hover:underline text-md">Don't have an account?</RouterLink>
    </div>
  </main>
</template>