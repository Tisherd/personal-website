<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    title: {
        type: String,
        required: true,
    },
    links: {
        type: Array,
        required: true,
        default: () => [],
    },
});
</script>

<template>
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 pl-8 font-bold text-lg border-b border-gray-700">
            {{ title }}
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <Link v-for="link in links" :key="link.href" :href="link.href" class="block py-2 px-4 rounded hover:bg-gray-700">
                {{ link.label }}
            </Link>
        </nav>
    </aside>
</template>
