<script setup>
import ResumeLayout from "@/Layouts/ResumeLayout.vue";
import { ref, computed } from 'vue';

const props = defineProps({
    workExperiences: Array,
    activeMonths: Number,
});

const sortOrder = ref("asc"); // Порядок сортировки: "asc" или "desc"

const sortedExperience = computed(() => {
    // Используем props напрямую
    return [...props.workExperiences].sort((a, b) => {
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
    <ResumeLayout>
        <div class="flex flex-col items-center justify-center mt-8">
            <!-- Основной блок с информацией -->
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mb-4">
                <h1 class="text-xl font-bold mb-2">Кол-во мест работы: {{ workExperiences.length }}</h1>
                <h1 class="text-xl font-bold mb-2">Опыт работы: {{ formattedPeriod(activeMonths) }}
                </h1>
                <!-- Кнопка для сортировки -->
                <button @click="toggleSortOrder"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                    {{ sortOrder === 'asc' ? 'От старых к новым' : 'От новых к старым' }}
                </button>
            </div>

            <!-- Блоки с контентом, которые раскрываются по клику -->
            <div v-for="experience in sortedExperience" :key="experience.id" class="w-full max-w-2xl mb-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <button @click="toggleBlock(experience)" class="w-full text-left font-semibold text-lg">
                        {{ experience.company_name }}
                        <span class="float-right">{{ experience.isOpen ? '-' : '+' }}</span>
                    </button>
                    <div v-if="experience.isOpen" class="mt-2 text-gray-700">
                        <p>Период работы: {{ experience.formatted_date_range }}</p>
                        <p>Период: {{ formattedPeriod(experience.period_in_month) }}</p>
                        <p>Должность: {{ experience.position }}</p>
                        <p>Описание: </p>
                        <p>{{ experience.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </ResumeLayout>
</template>
