<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import SecondaryButton from '@/Components/Base/SecondaryButton.vue';
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    aboutMe: Object,
});

const form = useForm({ ...props.aboutMe, photo: null });
const initialData = ref({ ...props.aboutMe, photo: null });
const oldPhotoUrl = ref(props.aboutMe.photo_path && `/storage/${props.aboutMe.photo_path}`);
const newPhotoUrl = ref(null);

// Определение изменений
const hasChanges = computed(() => {
    return (
        JSON.stringify(form.data()) !== JSON.stringify(initialData.value) ||
        newPhotoUrl.value !== null
    );
});

// Сбрасываем изменения
function cancelChanges() {
    form.reset();
    newPhotoUrl.value = null;
    resetFileInput();
}

// Сохраняем изменения
function saveChanges() {
    form.put(route("admin.about_me.update"), {
        preserveScroll: true,
        onSuccess: () => {
            Object.assign(initialData.value, form.data()); // Обновляем initialData после успешного сохранения
            oldPhotoUrl.value = newPhotoUrl.value || oldPhotoUrl.value; // Обновляем старое фото
            newPhotoUrl.value = null; // Сбрасываем новое фото
            resetFileInput();
        },
    });
}

// Сброс поля file
function resetFileInput() {
    const fileInput = document.getElementById("photo");
    if (fileInput) {
        fileInput.value = "";
    }
}

// Обработчик загрузки фото
function handlePhotoUpload(event) {
    const file = event.target.files[0];
    form.clearErrors('photo');
    if (file) {
        // Проверка формата и размера файла
        if (!file.type.startsWith("image/")) {
            form.setError('photo', "Пожалуйста, загрузите изображение.");
            resetFileInput();
            return;
        }
        if (file.size > 2 * 1024 * 1024) { // 2 MB
            form.setError('photo', "Размер файла не должен превышать 2MB.");
            resetFileInput();
            return;
        }
        form.photo = file;
        newPhotoUrl.value = URL.createObjectURL(file);
    }
}
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white">
                <h1 class="w-full text-2xl font-bold">
                    Обо мне
                </h1>
            </div>
            <form @submit.prevent="saveChanges" class="w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <InputLabel value="Фотография" />
                            <div class="flex items-center space-x-4 mt-2">
                                <div class="w-24 h-24 border rounded overflow-hidden">
                                    <img :src="newPhotoUrl || oldPhotoUrl" alt="Фото"
                                        class="w-full h-full object-cover" />
                                </div>
                                <input id="photo" type="file" accept="image/*" @change="handlePhotoUpload"
                                    class="block text-sm text-gray-500" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.photo" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Полное имя" />
                            <input id="fullName" v-model="form.full_name" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Дата рождения" />
                            <input id="birthDate" v-model="form.birth_date" type="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Обо мне" />
                            <textarea id="aboutMe" v-model="form.about_me" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Контакты" />
                            <input id="contacts" v-model="form.contacts" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6" v-if="hasChanges">
                    <div class="flex justify-end space-x-4">
                        <SecondaryButton @click="cancelChanges">
                            Отменить
                        </SecondaryButton>
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Обновить
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
