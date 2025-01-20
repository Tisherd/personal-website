<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    company_name: "",
    position: "",
    start_date: "",
    end_date: "",
    technology_stack: "",
    desc: "",
});

function store() {
    form.post(route('admin.work_experiences.store'))
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white">
                <h1 class="text-3xl font-bold text-gray-900">
                    Добавить опыт работы
                </h1>

                <Link :href="route('admin.work_experiences.index')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
                    Вернуться назад
                </Link>
            </div>

            <form @submit.prevent="store" class="w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <InputLabel value="Компания" />
                            <input :class="{ 'border-red-500': form.errors.company_name }" v-model="form.company_name" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.company_name" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Должность" />
                            <input :class="{ 'border-red-500': form.errors.position }" v-model="form.position" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.position" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Дата начала" />
                            <input :class="{ 'border-red-500': form.errors.start_date }" v-model="form.start_date" type="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                            <InputError class="mt-2" :message="form.errors.start_date" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Дата окончания" />
                            <input :class="{ 'border-red-500': form.errors.end_date }" v-model="form.end_date" type="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                            <InputError class="mt-2" :message="form.errors.end_date" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Технологии" />
                            <textarea
                                :class="{ 'border-red-500': form.errors.technology_stack }"
                                v-model="form.technology_stack"
                                rows="4"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </textarea>

                            <InputError class="mt-2" :message="form.errors.technology_stack" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Описание" />
                            <textarea
                                :class="{ 'border-red-500': form.errors.desc }"
                                v-model="form.desc"
                                rows="4"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </textarea>

                            <InputError class="mt-2" :message="form.errors.desc" />
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
