<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="bg-gray-600 text-white p-3">
        <ul class="flex space-x-4 pl-20">
            <li>
                <Link :href="route('about')">Обо мне</Link>
            </li>
            <li>
                <Link :href="route('work_experience')">Опыт</Link>
            </li>
            <li>
                <a href="https://github.com/Tisherd/andrey_ivanov_portfolio" target="_blank">Исходный код</a>
                <!-- <Link href="https://github.com/Tisherd/andrey_ivanov_portfolio">Исходный код</Link> -->
            </li>
            <li>
                <Link :href="route('users')" class="ml-10">Пользователи</Link>
            </li>
            <li>
                <Link href="/telescope">Telescope</Link>
            </li>
        </ul>
    </header>
</template>
