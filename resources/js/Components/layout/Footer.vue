<template>
    <footer class="fixed bottom-0 left-0 w-full bg-slate-600 text-white p-2 pl-20 flex justify-between items-center">
        <div class="flex space-x-4 pr-20">
            <a :href="hhUrl" target="_blank" class="hover:underline">HH.ru</a>
            <a :href="githubUrl" target="_blank" class="hover:underline">GitHub</a>
            <a :href="telegramUrl" target="_blank" class="hover:underline">Telegram</a>
        </div>
    </footer>
</template>

<script setup>
const hhUrl = import.meta.env.VITE_HH_URL;
const githubUrl = import.meta.env.VITE_GITHUB_URL;
const telegramUrl = import.meta.env.VITE_TELEGRAM_URL;
</script>
