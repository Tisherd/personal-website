<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import MainLayout from "../../Layouts/MainLayout.vue";

const form = useForm({
    login: null,
    password: null,
    desc: null,
    role: 'test',
});

function store() {
    form.post(route('users.store'))
}
</script>

<template>
    <MainLayout>
        <div class="bg-white shadow mb-10 ">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Добавить пользователя
                </h1>

                <Link :href="route('users.index')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
                    Вернуться назад
                </Link>
            </div>

            <form @submit.prevent="store">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Логин</label>
                            <input :class="{ 'border-red-500': form.errors.login }" v-model="form.login" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <div class="text-red-500 mt-2" v-if="form.errors.login">{{ form.errors.login }}</div>
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Пароль</label>
                            <input :class="{ 'border-red-500': form.errors.password }" v-model="form.password"
                                type="password"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <div class="text-red-500 mt-2" v-if="form.errors.password">{{ form.errors.password }}</div>
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Описание</label>
                            <textarea
                                v-model="form.desc"
                                rows="4"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </textarea>
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Добавить
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>
