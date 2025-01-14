<script setup>
import ResumeLayout from "@/Layouts/ResumeLayout.vue";

defineProps({
    aboutMe: Object,
});
</script>

<template>
    <ResumeLayout>
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mt-8">
            <div class="flex items-center mb-4">
                <img :src="aboutMe.photo_url" alt="Фото пользователя" class="h-36 rounded-full shadow-lg mr-4" />
                <div>
                    <h1 class="text-2xl font-bold">{{ aboutMe.full_name }}</h1>
                    <p class="text-gray-600"> {{ aboutMe.birthdate_formatted }} ({{
                        aboutMe.full_age }} лет)
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-2">Образование</h2>
                <!-- <p class="text-gray-700">{{ aboutMe.education }}</p> -->
            </div>
            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-2">Обо мне</h2>
                <!-- <p class="text-gray-700">{{ aboutMe.about_me }}</p> -->
            </div>
            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-2">Контакты</h2>
                <ul class="list-disc pl-5 text-gray-700">
                    <!-- <li>Email: {{ aboutMe.email }}</li>
                    <li>Телефон: {{ aboutMe.phone }}</li> -->
                </ul>
            </div>
        </div>
    </ResumeLayout>
</template>
