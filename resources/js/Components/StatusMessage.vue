<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const message = computed(() => usePage().props.message);

const isMessageVisible = ref(true);

const hideMessage = () => {
    isMessageVisible.value = false;
};
</script>

<template>
    <p v-if="message && isMessageVisible"
        class="bg-indigo-600 h-10 flex items-center justify-center text-sm font-medium text-white px-4 sm:px-6 lg:px-8 cursor-pointer"
        @click="hideMessage">
        {{ message }}
    </p>
</template>
