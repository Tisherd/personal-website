<script setup>
import ResumeLayout from "@/Layouts/ResumeLayout.vue";
import { ref } from 'vue';

// Хардкодим данные для примера
const questionGroups = ref([
    {
        label: 'Личные вопросы',
        sort_id: 1,
        isOpen: false,
        questions: [
            { question: 'Расскажите о себе.', answer: 'Я веб-разработчик с 5-летним опытом работы...', sort_id: 1, isOpen: false },
            { question: 'Какие у вас сильные стороны?', answer: 'Мои сильные стороны — это внимание к деталям и способность быстро учиться...', sort_id: 2, isOpen: false },
        ],
    },
    {
        label: 'Вопросы по навыкам',
        sort_id: 2,
        isOpen: false,
        questions: [
            { question: 'Какой ваш опыт работы с Vue.js?', answer: 'Я работаю с Vue.js более 3 лет...', sort_id: 1, isOpen: false },
            { question: 'Какие другие фреймворки вы использовали?', answer: 'Я использовал React и Angular в некоторых проектах...', sort_id: 2, isOpen: false },
        ],
    },
    {
        label: 'Вопросы по прошлым местам работы',
        sort_id: 3,
        isOpen: false,
        questions: [
            { question: 'Почему вы ушли с предыдущей работы?', answer: 'Я искал новые вызовы и возможности для профессионального роста...', sort_id: 1, isOpen: false },
            { question: 'Как вы решали проблемы на прошлом месте работы?', answer: 'Я всегда стремился к поиску решений через командную работу...', sort_id: 2, isOpen: false },
        ],
    },
]);

const toggleBlock = (block) => {
    block.isOpen = !block.isOpen;
};
</script>

<template>
    <ResumeLayout>
        <div class="flex flex-col items-center justify-center space-y-4 mt-8 mb-10">
            <div v-for="group in questionGroups" :key="group.label" class="w-full max-w-5xl">
                <div class="bg-green-100 p-4 rounded-lg shadow-md">

                    <button @click="toggleBlock(group)" class="w-full text-left font-bold text-lg">
                        {{ group.label }}
                        <span class="float-right">{{ group.isOpen ? '-' : '+' }}</span>
                    </button>

                    <div v-if="group.isOpen" class="mt-2 space-y-4">
                        <div v-for="question in group.questions" :key="question.question" class="border-b">
                            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                                <button @click="toggleBlock(question)" class="w-full text-left font-medium">
                                    {{ question.question }}
                                    <span class="float-right">{{ question.isOpen ? '-' : '+' }}</span>
                                </button>
                                <div v-if="question.isOpen" class="mt-2 text-gray-600">
                                    {{ question.answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ResumeLayout>
</template>
