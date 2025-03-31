<script setup>
import HeaderComponent from "@/Components/layout/Header.vue";
import FooterComponent from "@/Components/layout/Footer.vue";
import AsideComponent from "@/Components/layout/Aside.vue";

const asideLinks = [
    { href: route('resume.about_me.index'), label: "Обо мне" },
    { href: route('resume.work_experiences.index'), label: "Опыт работы" },
    { href: route('resume.skills.index'), label: "Навыки" },
    { href: route('resume.questions.index'), label: "Вопросы" },
];
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <!-- Хедер -->
        <HeaderComponent />

        <!-- Основной контейнер (aside + main) -->
        <div class="flex flex-grow bg-gray-100">
            <!-- Боковая панель -->
            <AsideComponent title="Резюме" :links="asideLinks" />

            <!-- Основное содержимое -->
            <main class="flex-grow container mx-auto px-4 py-8">
                <slot />
            </main>
        </div>

        <!-- Футер -->
        <FooterComponent />
    </div>
</template>
