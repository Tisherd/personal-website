<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    projects: Object,
});

function destroy(id) {
    if (confirm("Вы уверены?")) {
        router.delete(route('admin.projects.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-bold mb-4 ml-5">Проекты</h1>

        <Link :href="route('admin.projects.create')" class="ml-5 text-indigo-600 hover:text-indigo-900 my-5 block">
            Добавить проект
        </Link>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div v-if="projects.total > 0" class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Проект
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Действия</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="project in projects.data" :key="project.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ project.title }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                    <Link
                                        class="text-indigo-600 hover:text-indigo-900"
                                        :href="route('admin.projects.edit', project.id)"
                                    >Редактировать</Link>

                                    <a @click="destroy(project.id)" class="text-red-600 hover:text-red-900 cursor-pointer"
                                    >Удалить</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <Pagination :links="projects.links" />
                    </div>

                    <div v-else class="text-center font-bold text-xl">
                        Проектов пока нет
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
