<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import AboutMe from "./AboutMe.vue";

defineProps({
    aboutMe: Object,
});

</script>

<template>
    <MainLayout>
        <div class="flex flex-col items-center bg-gray-100">
            <!-- Карточка с информацией -->
            <AboutMe :aboutMe="aboutMe"/>
        </div>
    </MainLayout>
</template>
