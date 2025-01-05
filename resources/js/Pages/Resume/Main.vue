<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import AboutMe from "./AboutMe.vue";
import WorkExperience from "./WorkExperience.vue";

defineProps({
    aboutMe: Object,
    workExperience: Object,
});

</script>

<template>
    <MainLayout>
        <div class="flex flex-col items-center bg-gray-100">
            <AboutMe :aboutMe="aboutMe"/>
            <WorkExperience :workExperience="workExperience"/>
        </div>
    </MainLayout>
</template>
