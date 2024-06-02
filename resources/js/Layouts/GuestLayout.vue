<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 contenido">


        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<style>
.contenido {
    background: rgb(89, 44, 3);
    background: linear-gradient(0deg, rgba(89, 44, 3, 1) 0%, rgba(191, 95, 7, 1) 100%);

}
</style>
