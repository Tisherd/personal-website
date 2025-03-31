<script setup>
import HeaderComponent from "@/Components/layout/Header.vue";
import FooterComponent from "@/Components/layout/Footer.vue";
import AdminLeftPanel from "@/Layouts/Aside/AdminLeftPanel.vue";
</script>

<template>
    <div class="bg-gray-100 text-gray-800 flex flex-col min-h-screen overflow-hidden">
        <HeaderComponent />
        <div class="flex flex-grow">
            <AdminLeftPanel />
            <main class="container mx-auto px-4 py-8 flex-grow">
                <slot />
            </main>
        </div>
        <FooterComponent />
    </div>
</template>

