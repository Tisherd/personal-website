<script setup>
import HeaderComponent from "@/Components/layout/Header.vue";
import FooterComponent from "@/Components/layout/Footer.vue";
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <!-- Хедер -->
        <HeaderComponent />

        <!-- Основной контейнер -->
        <div class="flex flex-grow bg-gray-100">
            <!-- Основное содержимое -->
            <main class="flex-grow container mx-auto px-4 py-8">
                <slot />
            </main>
        </div>

        <!-- Футер -->
        <FooterComponent />
    </div>
</template>
