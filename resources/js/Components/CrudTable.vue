<script setup>
import { defineProps } from "vue";
import { Link, router } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";

defineProps({
    headerTitle: String,
    headers: Array,
    items: Array,
    links: Array,
    routes: Object,
});

function getNestedValue(obj, path) {
    return path.split('.').reduce((acc, key) => acc && acc[key], obj);
}

function destroy(routed, id) {
    if (confirm("Вы уверены?")) {
        router.delete(route(routed, id));
    }
}
</script>

<template>
    <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="w-full text-left my-6 ml-10">
            <h1 class="text-2xl font-bold">{{ headerTitle }}</h1>
            <Link :href="route(routes.create)" class="text-indigo-600 hover:text-indigo-900 mt-2 block">
                Добавить
            </Link>
        </div>

        <div class="w-full shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div v-if="items.length > 0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                v-for="header in headers"
                                :key="header.key"
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                {{ header.label }}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Действия</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="item in items" :key="item.id">
                            <td
                                v-for="header in headers"
                                :key="header.key"
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                            >
                                {{ getNestedValue(item, header.key) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                <Link
                                    class="text-indigo-600 hover:text-indigo-900"
                                    :href="route(routes.edit, item.id)"
                                >Редактировать</Link>
                                <a @click="destroy(routes.destroy, item.id)" class="text-red-600 hover:text-red-900 cursor-pointer"
                                >Удалить</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else class="text-center font-bold text-xl py-10">
                Нет данных для отображения
            </div>
        </div>

        <Pagination :links="links" />
    </div>

</template>
