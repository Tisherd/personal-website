<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 font-bold text-lg border-b border-gray-700">
            Резюме
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <Link :href="route('resume.about_me.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
            Обо мне
            </Link>
            <Link :href="route('resume.work_experience.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
            Опыт работы
            </Link>
            <!-- <Link :href="route('resume.skills.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
            Навыки
            </Link> -->
            <!-- <Link :href="route('resume.questions.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
            Вопросы
            </Link> -->
        </nav>
    </aside>
</template>
