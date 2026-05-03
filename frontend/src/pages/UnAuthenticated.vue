<script setup>


</script>

<template>
    <main class="grid grid-cols-5 ">
        <div class="flex flex-col justify-center col-span-3 col-start-2">
            <h2 class="font-bold text-2xl self-center">Authentication requiered</h2>

            <img src="/public/error/UnAuthenticated.png" alt="">

            <div class="flex gap-4 self-center">
                <RouterLink to="/login" class="text-text font-bold hover:underline text-md">Already have an account?
                </RouterLink>
                <RouterLink to="/register" class="text-text font-bold hover:underline text-md">Don't have an account?
                </RouterLink>
            </div>
        </div>
    </main>
</template>