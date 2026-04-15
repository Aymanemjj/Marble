<script setup>
import BasicInput from '../components/BasicInput.vue';
import router from '../router';

let Auth = JSON.parse(localStorage.getItem('user')) || router.push('/register')

</script>

<template>
    <main>
        <div>
            <form action="">
                <BasicInput :type="sel"/>
            </form>
        </div>
    </main>
</template>