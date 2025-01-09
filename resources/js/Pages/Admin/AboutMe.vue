<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

// Получение данных из props
const props = defineProps({
    aboutMe: Object,
});

// Инициализация данных формы
const form = useForm({ ...props.aboutMe });
const initialData = ref({ ...props.aboutMe }); // Сохраняем начальные данные для сравнения
const oldPhotoUrl = ref(props.aboutMe.photo_url || "/images/default_photo.jpg"); // Старое фото
const newPhotoUrl = ref(null); // Новое фото для предпросмотра
const hasChanges = ref(false); // Флаг наличия изменений

// Обновляем флаг изменений при изменении данных формы
watch(
    () => form.data(),
    () => {
        hasChanges.value = JSON.stringify(form.data()) !== JSON.stringify(initialData.value);
    },
    { deep: true }
);

// Сбрасываем изменения
function cancelChanges() {
    form.reset();
    newPhotoUrl.value = null; // Убираем новое фото
    hasChanges.value = false;
}

// Сохраняем изменения
function saveChanges() {
    form.post(route("admin.about_me.update"), {
        preserveScroll: true,
        onSuccess: () => {
            Object.assign(initialData.value, form.data()); // Обновляем initialData после успешного сохранения
            oldPhotoUrl.value = newPhotoUrl.value || oldPhotoUrl.value; // Обновляем старое фото
            newPhotoUrl.value = null; // Сбрасываем новое фото
            hasChanges.value = false; // Сбрасываем флаг изменений
        },
    });
}

// Обработчик загрузки нового фото
function handlePhotoUpload(event) {
    const file = event.target.files[0];
    if (file) {
        form.photo = file; // Добавляем файл в форму
        newPhotoUrl.value = URL.createObjectURL(file); // Генерируем URL для предварительного просмотра
    }
}
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-bold">Обо мне</h1>
        <form @submit.prevent="saveChanges" class="mt-6 space-y-4">
            <!-- ФИО -->
            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700">ФИО</label>
                <input
                    id="fullName"
                    v-model="form.full_name"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>

            <!-- Дата рождения -->
            <div>
                <label for="birthDate" class="block text-sm font-medium text-gray-700">Дата рождения</label>
                <input
                    id="birthDate"
                    v-model="form.birth_date"
                    type="date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>

            <!-- Обо мне -->
            <div>
                <label for="aboutMe" class="block text-sm font-medium text-gray-700">Обо мне</label>
                <textarea
                    id="aboutMe"
                    v-model="form.about_me"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                ></textarea>
            </div>

            <!-- Контакты -->
            <div>
                <label for="contacts" class="block text-sm font-medium text-gray-700">Контакты</label>
                <input
                    id="contacts"
                    v-model="form.contacts"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>

            <!-- Фото -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Фотография</label>
                <div class="flex items-center space-x-4 mt-2">
                    <!-- Старое фото -->
                    <div v-if="oldPhotoUrl" class="w-24 h-24 border rounded overflow-hidden">
                        <img :src="oldPhotoUrl" alt="Старое фото" class="w-full h-full object-cover" />
                    </div>

                    <!-- Новое фото -->
                    <div v-if="newPhotoUrl" class="w-24 h-24 border rounded overflow-hidden">
                        <img :src="newPhotoUrl" alt="Новое фото" class="w-full h-full object-cover" />
                    </div>

                    <!-- Загрузка фото -->
                    <input
                        id="photo"
                        type="file"
                        accept="image/*"
                        @change="handlePhotoUpload"
                        class="block text-sm text-gray-500"
                    />
                </div>
            </div>

            <!-- Кнопки -->
            <div class="flex justify-end space-x-4" v-if="hasChanges">
                <button
                    type="button"
                    @click="cancelChanges"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                >
                    Отменить
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                >
                    Сохранить
                </button>
            </div>
        </form>
    </AdminLayout>
</template>
