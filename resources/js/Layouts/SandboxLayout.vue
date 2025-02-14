<script setup>
import HeaderComponent from "@/Components/Header.vue";
import FooterComponent from "@/Components/Footer.vue";
import SandboxLeftPanel from "./Aside/SandboxLeftPanel.vue";
</script>

<template>
    <div class="bg-gray-100 text-gray-800 flex flex-col min-h-screen overflow-hidden">
        <HeaderComponent />
        <div class="flex flex-grow">
            <SandboxLeftPanel />
            <main class="container mx-auto px-4 py-8 flex-grow">
                <slot />
            </main>
        </div>
        <FooterComponent />
    </div>
</template>

