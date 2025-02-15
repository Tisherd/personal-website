<script setup>
import SandboxLayout from "@/Layouts/SandboxLayout.vue";
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const items = ref(page.props.items);
const googleSheetUrl = ref(page.props.googleSheetUrl || '');

const deleteItem = (id) => {
    if (confirm('Вы уверены?')) {
        router.delete(route('sandbox.google_table_sync.destroy', id));
    }
};

const generateItems = () => {
    if (confirm('Сгенерировать 1000 строк?')) {
        router.post(route('sandbox.google_table_sync.generate'));
    }
};

const clearTable = () => {
    if (confirm('Очистить таблицу?')) {
        router.post(route('sandbox.google_table_sync.clear'));
    }
};

const updateGoogleSheetUrl = () => {
    router.post(route('sandbox.google_table_sync.update-google-sheet'), { googleSheetUrl: googleSheetUrl.value });
};
</script>

<template>
    <SandboxLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Синхронизация с Google Table</h1>

            <!-- Google Sheets URL -->
            <div class="mb-4">
                <label class="block font-semibold">Google Sheet URL:</label>
                <input v-model="googleSheetUrl" type="text" class="border p-2 rounded w-full" />
                <button @click="updateGoogleSheetUrl" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Сохранить</button>
            </div>

            <!-- Кнопки -->
            <div class="mb-4 space-x-2">
                <button @click="generateItems" class="bg-green-500 text-white px-4 py-2 rounded">Сгенерировать 1000 строк</button>
                <button @click="clearTable" class="bg-red-500 text-white px-4 py-2 rounded">Очистить таблицу</button>
            </div>

            <!-- Таблица -->
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Название</th>
                        <th class="border px-4 py-2">Значение</th>
                        <th class="border px-4 py-2">Содержание</th>
                        <th class="border px-4 py-2">Статус</th>
                        <th class="border px-4 py-2">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="border px-4 py-2 text-center">{{ item.id }}</td>
                        <td class="border px-4 py-2 text-center">{{ item.title }}</td>
                        <td class="border px-4 py-2 text-center">{{ item.value }}</td>
                        <td class="border px-4 py-2 text-center">{{ item.content }}</td>
                        <td class="border px-4 py-2 text-center">
                            <span :class="item.status === 'Allowed' ? 'text-green-600' : 'text-red-600'">
                                {{ item.status }}
                            </span>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button @click="deleteItem(item.id)" class="bg-red-500 text-white px-2 py-1 rounded">Удалить</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </SandboxLayout>
</template>
