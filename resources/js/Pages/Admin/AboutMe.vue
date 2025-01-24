<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import SecondaryButton from '@/Components/Base/SecondaryButton.vue';
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    full_name: String,
    birth_date: String,
    description: String,
    photo_path: String,
    contacts: Object,
});

console.log(props);

const initialData = {...props, photo: null};

const form = useForm(initialData);
const oldPhotoUrl = ref(initialData.photo_path && `/storage/${initialData.photo_path}`);
const newPhotoUrl = ref(null);

const hasChanges = computed(() => {
    return (
        JSON.stringify(form.data()) !== JSON.stringify(initialData) ||
        newPhotoUrl.value !== null
    );
});

function cancelChanges() {
    form.reset();
    newPhotoUrl.value = null;
    resetFileInput();
}

function saveChanges() {
    form.post(route("admin.about_me.update"), {
        preserveScroll: true,
        onSuccess: () => {
            Object.assign(initialData, form.data()); // Обновляем initialData после успешного сохранения
            oldPhotoUrl.value = newPhotoUrl.value || oldPhotoUrl.value; // Обновляем старое фото
            newPhotoUrl.value = null; // Сбрасываем новое фото
            resetFileInput();
        },
    });
}

function resetFileInput() {
    const fileInput = document.getElementById("photo");
    if (fileInput) {
        fileInput.value = "";
    }
}

function handlePhotoUpload(event) {
    const file = event.target.files[0];
    form.clearErrors('photo');
    if (file) {
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
        <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 mb-32">
            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white">
                <h1 class="w-full text-2xl font-bold">
                    Обо мне
                </h1>
            </div>
            <form @submit.prevent="saveChanges" class="w-full">
                <div class="px-4 py-5 bg-white sm:p-6 space-y-8">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">
                            Общее
                        </h2>
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
                                <input v-model="form.full_name" type="text"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError class="mt-2" :message="form.errors.full_name" />
                            </div>

                            <div class="col-span-6">
                                <InputLabel value="Дата рождения" />
                                <input v-model="form.birth_date" type="date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError class="mt-2" :message="form.errors.birth_date" />
                            </div>

                            <div class="col-span-6">
                                <InputLabel value="Обо мне" />
                                <textarea v-model="form.description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">
                            Контакты
                        </h2>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <InputLabel value="Email" />
                                <input v-model="form.contacts.email" type="text"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError class="mt-2" :message="form.errors['contacts.email']" />
                            </div>

                            <div class="col-span-6">
                                <InputLabel value="Телефон" />
                                <input v-model="form.contacts.phone" type="tel" placeholder="+7 (___) ___-__-__"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError class="mt-2" :message="form.errors['contacts.phone']" />
                            </div>

                            <div class="col-span-6">
                                <InputLabel value="Telegram" />
                                <input v-model="form.contacts.telegram" type="text"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError class="mt-2" :message="form.errors['contacts.telegram']" />
                            </div>
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
