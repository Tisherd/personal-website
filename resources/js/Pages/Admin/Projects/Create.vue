<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: "",
    description: "",
    github_url: "",
    live_url: "",
});

function store() {
    form.post(route('admin.projects.store'))
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white">
                <h1 class="text-3xl font-bold text-gray-900">
                    Добавить проект
                </h1>

                <Link :href="route('admin.projects.index')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
                    Вернуться назад
                </Link>
            </div>

            <form @submit.prevent="store" class="w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <InputLabel value="Название проекта" />
                            <input :class="{ 'border-red-500': form.errors.title }" v-model="form.title" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Ссылка на github" />
                            <input :class="{ 'border-red-500': form.errors.github_url }" v-model="form.github_url" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.github_url" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Ссылка на ресурс" />
                            <input :class="{ 'border-red-500': form.errors.live_url }" v-model="form.live_url" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.live_url" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Описание" />
                            <textarea
                                :class="{ 'border-red-500': form.errors.description }"
                                v-model="form.description"
                                rows="4"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </textarea>

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Добавить
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
