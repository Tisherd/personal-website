<script setup>
import MainLayout from "../Layouts/MainLayout.vue";

defineProps({
    experience: Array,
});

const toggleBlock = (block) => { //
    block.isOpen = !block.isOpen;
};

const iso8601DateToLongMonthWithYear = (iso8601Date) => {
    const date = new Date(iso8601Date);
    const options = { month: 'long', year: 'numeric' };
    return date.toLocaleString('ru-RU', options);
}
</script>

<template>
    <MainLayout>
        <div class="flex flex-col items-center bg-gray-100">
            <!-- Основной блок с информацией -->
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mb-4">
                <h1 class="text-xl font-bold mb-2">Кол-во мест работы: 3</h1>
                <h1 class="text-xl font-bold mb-2">Опыт работы: 1 год 8 месяцев</h1>
            </div>

            <!-- Блоки с контентом, которые раскрываются по клику -->
            <div v-for="(block, index) in experience" :key="block.id" class="w-full max-w-2xl mb-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <button @click="toggleBlock(block)" class="w-full text-left font-semibold text-lg">
                        {{ block.company_name }}
                        <span class="float-right">{{ block.isOpen ? '-' : '+' }}</span>
                    </button>
                    <div v-if="block.isOpen" class="mt-2 text-gray-700">
                        <p>Период работы: {{ iso8601DateToLongMonthWithYear(block.start_date) }} - {{ iso8601DateToLongMonthWithYear(block.end_date) }}</p>
                        <p>Должность: {{ block.position }}</p>
                        <p>Стек технологий:</p>
                        <ul class="list-disc pl-5 ">
                            <li v-for="item in block.technology_stack" class="mb-1 text-gray-800">
                              <p>{{ item }}</p>
                            </li>
                        </ul>
                        <p>Описание: </p>
                        <p>{{ block.desc }}</p>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
