<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    workExperiences: Object,
});

const destroy = (id) => {
    if (confirm("Вы уверены?")) {
        router.delete(route('admin.work_experiences.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-bold mb-4 ml-5">Work experience</h1>

        <Link :href="route('admin.work_experiences.create')" class="ml-5 text-indigo-600 hover:text-indigo-900 my-5 block">
            Добавить запись об опыте работы
        </Link>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div v-if="workExperiences.total > 0" class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Компания
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Действия</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="workExperience in workExperiences.data" :key="workExperience.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ workExperience.company_name }}
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                    <Link
                                        class="text-indigo-600 hover:text-indigo-900"
                                        :href="route('admin.work_experiences.edit', user.id)"
                                    >Редактировать</Link>

                                    <a @click="destroy(user.id)" class="text-red-600 hover:text-red-900 cursor-pointer"
                                    >Удалить</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <Pagination :links="users.links" />
                    </div>

                    <div v-else class="text-center font-bold text-xl">
                        Записей об опыте работы пока нет
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
