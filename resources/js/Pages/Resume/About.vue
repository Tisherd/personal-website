<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";

defineProps({
    about: Object,
});

const formattedDate = (dateOfBirth) => {
    const date = new Date(dateOfBirth);
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('ru-RU', options);
};

// Функция для вычисления возраста
const calculateAge = (dateOfBirth) => {
    const birthDate = new Date(dateOfBirth);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
};
</script>

<template>
    <MainLayout>
        <div class="flex flex-col items-center bg-gray-100">
            <!-- Карточка с информацией -->
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mt-8">
                <div class="flex items-center mb-4">
                    <img :src="about.photo" alt="Фото пользователя" class="h-36 rounded-full shadow-lg mr-4" />
                    <div>
                        <h1 class="text-2xl font-bold">{{ about.full_name }}</h1>
                        <p class="text-gray-600"> {{ formattedDate(about.date_of_birth) }} ({{
                            calculateAge(about.date_of_birth) }} лет)
                        </p>
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
