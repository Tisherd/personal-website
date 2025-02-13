<script setup>
import ResumeLayout from "@/Layouts/ResumeLayout.vue";

defineProps({
    photo_url: String,
    full_name: String,
    description: String,
    birthdate_formatted: String,
    full_age: Number,
    contacts: Object,
});
</script>

<template>
    <ResumeLayout>
        <div class="flex justify-center mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                <div class="flex items-center mb-4">
                    <img :src="photo_url" alt="Фото пользователя" class="h-36 rounded-full shadow-lg mr-4" />
                    <div>
                        <h1 class="text-2xl font-bold">{{ full_name }}</h1>
                        <p class="text-gray-600"> {{ birthdate_formatted }} ({{ full_age }} лет)
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Обо мне</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ description }}</p>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Контакты</h2>
                    <ul class="list-disc pl-5 text-gray-700">
                        <li v-if="contacts.email">Email: {{ contacts.email }}</li>
                        <li v-if="contacts.phone">Телефон: {{ contacts.phone }}</li>
                        <li v-if="contacts.telegram">
                            Телеграм:
                            <a :href="contacts.telegram"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="hover:underline">
                                {{ contacts.telegram }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </ResumeLayout>
</template>
