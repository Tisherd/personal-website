<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    workExperience: {
        type: Object,
        required: true,
        validator(value) {
            return (
                Array.isArray(value.experience) &&
                typeof value.count === "number" &&
                typeof value.totalPeriodInMonth === "number"
            );
        },
    },
});

const sortOrder = ref("asc"); // Порядок сортировки: "asc" или "desc"

const sortedExperience = computed(() => {
    // Используем props напрямую
    return [...props.workExperience.experience].sort((a, b) => {
        const dateA = new Date(a.start_date);
        const dateB = new Date(b.start_date);
        return sortOrder.value === "asc" ? dateA - dateB : dateB - dateA;
    });
});

const toggleBlock = (block) => {
    block.isOpen = !block.isOpen;
};

const toggleSortOrder = () => {
    sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
};

const iso8601DateToLongMonthWithYear = (iso8601Date) => {
    const date = new Date(iso8601Date);
    const options = { month: 'long', year: 'numeric' };
    return date.toLocaleString('ru-RU', options);
};

const formattedPeriod = (periodInMonth) => {
    const years = Math.floor(periodInMonth / 12);
    const months = periodInMonth % 12;

    let result = '';
    if (years >= 5) {
        result += `${years} лет`;
    } else if (years >= 2) {
        result += `${years} года`;
    } else if (years > 0) {
        result += `${years} год`;
    }
    if (months >= 5) {
        result += ` ${months} месяцев`;
    } else if (months >= 2) {
        result += ` ${months} месяца`;
    } else if (months > 0) {
        result += ` ${months} месяц`;
    }

    return result.trim();
};
</script>

<template>
    <!-- Основной блок с информацией -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mb-4">
        <h1 class="text-xl font-bold mb-2">Кол-во мест работы: {{ workExperience.count }}</h1>
        <h1 class="text-xl font-bold mb-2">Опыт работы: {{ formattedPeriod(workExperience.totalPeriodInMonth) }}</h1>
        <!-- Кнопка для сортировки -->
        <button @click="toggleSortOrder"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
            {{ sortOrder === 'asc' ? 'От старых к новым' : 'От новых к старым' }}
        </button>
    </div>

    <!-- Блоки с контентом, которые раскрываются по клику -->
    <div v-for="(block, index) in sortedExperience" :key="block.id" class="w-full max-w-2xl mb-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <button @click="toggleBlock(block)" class="w-full text-left font-semibold text-lg">
                {{ block.company_name }}
                <span class="float-right">{{ block.isOpen ? '-' : '+' }}</span>
            </button>
            <div v-if="block.isOpen" class="mt-2 text-gray-700">
                <p>Период работы: {{ iso8601DateToLongMonthWithYear(block.start_date) }} - {{
                    iso8601DateToLongMonthWithYear(block.end_date) }}</p>
                <p>Период: {{ formattedPeriod(block.period_in_month) }}</p>
                <p>Должность: {{ block.position }}</p>
                <p>Стек технологий:</p>
                <ul class="list-disc pl-5">
                    <li v-for="item in block.technology_stack" class="mb-1 text-gray-800">
                        <p>{{ item }}</p>
                    </li>
                </ul>
                <p>Описание: </p>
                <p>{{ block.desc }}</p>
            </div>
        </div>
    </div>
</template>
