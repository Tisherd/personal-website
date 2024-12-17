<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header>
        <ul>
            <!-- <li>
                <router-link to="/">Home</router-link>
            </li>
            <li>
                <router-link to="/about">About</router-link>
            </li> -->
            <li>
                <Link :href="route('about')">Обо мне</Link>
            </li>
            <li>
                <Link :href="route('work_experience')">Опыт</Link>
            </li>
            <!-- <li>
                <router-link to="/contact">Contact</router-link>
            </li> -->
        </ul>
    </header>
</template>
