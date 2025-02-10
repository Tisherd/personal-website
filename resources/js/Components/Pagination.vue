<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3"
        class="px-4 py-3 flex items-center justify-between sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                    <Link v-for="(link, k) in links"
                        :href="link.url || '#'"
                        :key="k"
                        :disabled="(link.url === null) || (link.active)"
                        :class="[
                            link.active ? 'text-blue-500 font-bold pointer-events-none' : 'text-gray-500',
                            link.url === null ? 'bg-gray-100 pointer-events-none' : 'hover:bg-gray-50',
                            'bg-white border-gray-300 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                        ]"
                        v-html="link.label"
                    />
                </nav>
            </div>
        </div>
    </div>
</template>
