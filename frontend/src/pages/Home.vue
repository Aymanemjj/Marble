<script setup>
import router from '../router';

let Auth = JSON.parse(localStorage.getItem('user')) || router.push('/register')

</script>

<template>
    <main>
        <h1>Welcome {{ Auth.firstname }} {{ Auth.lastname }} to your profile</h1>
    </main>
</template>