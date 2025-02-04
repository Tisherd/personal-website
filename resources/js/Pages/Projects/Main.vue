<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { ref } from "vue";

const projects = ref([
    {
        title: "Personal Website",
        description: "A personal website built with Laravel, Inertia.js, and Vue 3 to showcase my resume and projects.",
        github_url: "https://github.com/Tisherd/personal-website",
        live_url: "https://tisherd.info/",
        img: "https://images/projects/project_stub.webp"
    }
]);
</script>

<template>
    <MainLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold mb-8 text-center">My Projects</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="project in projects" :key="project.title" class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img v-if="project.img" :src="project.img" :alt="project.title" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ project.title }}</h2>
                        <p class="text-gray-600 mb-4">{{ project.description }}</p>
                        <div class="flex justify-between items-center">
                            <a :href="project.github_url" target="_blank" class="text-blue-500 hover:underline">GitHub</a>
                            <a :href="project.live_url" target="_blank" class="text-green-500 hover:underline">Live Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
