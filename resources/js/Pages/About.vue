<script setup>
import MainLayout from "../Layouts/MainLayout.vue";

defineProps({
    about: Object, // Данные о пользователе, передаются из контроллера
});
</script>

<template>
    <MainLayout>
        <div class="flex flex-col items-center bg-gray-100">
            <!-- Карточка с информацией -->
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mt-8">
                <div class="flex items-center mb-4">
                    <img
                        :src="about.photo"
                        alt="Фото пользователя"
                        class="w-24 h-24 rounded-full shadow-lg mr-4"
                    />
                    <div>
                        <h1 class="text-2xl font-bold">{{ about.full_name }}</h1>
                        <p class="text-gray-600">{{ about.date_of_birth }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Образование</h2>
                    <p class="text-gray-700">{{ about.education }}</p>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Обо мне</h2>
                    <p class="text-gray-700">{{ about.about_me }}</p>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Контакты</h2>
                    <ul class="list-disc pl-5 text-gray-700">
                        <li>Email: {{ about.email }}</li>
                        <li>Телефон: {{ about.phone }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
