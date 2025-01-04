<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FooterComponent from "../Components/Footer.vue";
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col bg-gray-100">
        <main class="flex flex-col items-center justify-center container mx-auto flex-grow -mt-32">
            <div>
                <Link href="/">
                    <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </div>
            <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                <slot />
            </div>
        </main>
        <FooterComponent />
    </div>
</template>
