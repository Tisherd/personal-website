<script setup>
import LeftPanel from "@/Components/LeftPanel.vue";

const links = [
    { href: route('resume.about_me.index'), label: "Обо мне" },
    { href: route('resume.work_experiences.index'), label: "Опыт работы" },
    { href: route('resume.skills.index'), label: "Навыки" },
    { href: route('resume.questions.index'), label: "Вопросы" },
];
</script>

<template>
    <LeftPanel title="Резюме" :links="links" />
</template>
