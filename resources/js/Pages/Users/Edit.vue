<script setup>
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';
import MainLayout from "../../Layouts/MainLayout.vue";

const props = defineProps({
    user: Object,
    roles: Object,
});

const form = useForm({
    login: props.user.login,
    desc: props.user.desc,
    role_id: props.user.role_id,
});

function update() {
    form.put(route('users.update', props.user.id))
};
</script>

<template>
    <MainLayout>
        <div class="bg-white shadow mb-10 ">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Редактировать пользователя
                </h1>

                <Link :href="route('users.index')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
                    Вернуться назад
                </Link>
            </div>

            <form @submit.prevent="update">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <InputLabel value="Логин" />
                            <input :class="{ 'border-red-500': form.errors.login }" v-model="form.login" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.login" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Роль" />
                            <select
                                v-model="form.role_id"
                                :class="{ 'border-red-500': form.errors.role_id }"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled>Выберите роль</option>
                                <option v-for="(title, id) in roles" :key="id" :value="id">
                                    {{ title }}
                                </option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.role_id" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Описание" />
                            <textarea
                                v-model="form.desc"
                                rows="4"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </textarea>
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Обновить
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>
