<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

const initialData = {
    fullName: "Иван Иванов",
    birthDate: "1990-01-01",
    photo: null,
    aboutMe: "Пример текста обо мне...",
    contacts: "example@example.com, +123456789",
};

const form = useForm({ ...initialData });

const isChanged = computed(() => {
    return JSON.stringify(form.data()) !== JSON.stringify(initialData);
});

function saveChanges() {
    form.post(route("admin.aboutMe.update"), {
        preserveScroll: true,
        onSuccess: () => {
            Object.assign(initialData, form.data());
        },
    });
}

function resetChanges() {
    form.reset();
}
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-bold mb-6">Обо мне</h1>

        <form @submit.prevent="saveChanges" class="space-y-6">
            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700">ФИО</label>
                <input
                    v-model="form.fullName"
                    type="text"
                    id="fullName"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <div>
                <label for="birthDate" class="block text-sm font-medium text-gray-700">Дата рождения</label>
                <input
                    v-model="form.birthDate"
                    type="date"
                    id="birthDate"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Фотография</label>
                <input
                    @change="form.photo = $event.target.files[0]"
                    type="file"
                    id="photo"
                    accept="image/*"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <label for="aboutMe" class="block text-sm font-medium text-gray-700">Обо мне</label>
                <textarea
                    v-model="form.aboutMe"
                    id="aboutMe"
                    rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                ></textarea>
            </div>

            <div>
                <label for="contacts" class="block text-sm font-medium text-gray-700">Контакты</label>
                <textarea
                    v-model="form.contacts"
                    id="contacts"
                    rows="2"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                ></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <button
                    type="button"
                    @click="resetChanges"
                    :disabled="!isChanged"
                    class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                >
                    Отменить
                </button>
                <button
                    type="submit"
                    :disabled="!isChanged"
                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                >
                    Сохранить
                </button>
            </div>
        </form>
    </AdminLayout>
</template>
