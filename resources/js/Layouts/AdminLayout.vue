<script setup>
import HeaderComponent from "@/Components/layout/Header.vue";
import FooterComponent from "@/Components/layout/Footer.vue";
import AsideComponent from "@/Components/layout/Aside.vue";

const asideLinks = [
    { href: route('admin.about_me.index'), label: "Обо мне" },
    { href: route('admin.work_experiences.index'), label: "Опыт работы" },
    { href: route('admin.projects.index'), label: "Проекты" },
    { href: route('admin.users.index'), label: "Пользователи" },
    { href: route('admin.skill_groups.index'), label: "Группа навыков" },
    { href: route('admin.skills.index'), label: "Навыки" },
    { href: "/telescope", label: "Telescope" },
];
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <!-- Хедер -->
        <HeaderComponent />

        <!-- Основной контейнер (aside + main) -->
        <div class="flex flex-grow bg-gray-100">
            <!-- Боковая панель -->
            <AsideComponent title="Панель администратора" :links="asideLinks" />

            <!-- Основное содержимое -->
            <main class="flex-grow container mx-auto px-4 py-8">
                <slot />
            </main>
        </div>

        <!-- Футер -->
        <FooterComponent />
    </div>
</template>
