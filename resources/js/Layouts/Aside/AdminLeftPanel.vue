<script setup>
import LeftPanel from "@/Components/LeftPanel.vue";

const links = [
    { href: route('admin.about_me.index'), label: "Обо мне" },
    { href: route('admin.work_experiences.index'), label: "Опыт работы" },
    { href: route('admin.users.index'), label: "Пользователи" },
    { href: "/telescope", label: "Telescope" },
];
</script>

<template>
    <LeftPanel title="Панель администратора" :links="links" />
</template>
