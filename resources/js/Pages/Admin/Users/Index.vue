<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    users: Object,
});

const destroy = (id) => {
    if (confirm("Вы уверены?")) {
        router.delete(route('admin.users.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col items-center justify-center mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="w-full text-left my-6 ml-10">
                <h1 class="text-2xl font-bold">Пользователи</h1>
                <Link :href="route('admin.users.create')" class="text-indigo-600 hover:text-indigo-900 mt-2 block">
                    Добавить пользователя
                </Link>
            </div>

            <div class="w-full shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div v-if="users.total > 0">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Логин
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Имя
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Роль
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Описание
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Действия</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ user.login }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ user.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ user.role.title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ user.desc }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                    <Link
                                        class="text-indigo-600 hover:text-indigo-900"
                                        :href="route('admin.users.edit', user.id)"
                                    >Редактировать</Link>
                                    <a @click="destroy(user.id)" class="text-red-600 hover:text-red-900 cursor-pointer"
                                    >Удалить</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="users.links" />
                </div>

                <div v-else class="text-center font-bold text-xl py-10">
                    Пользователей пока нет
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
