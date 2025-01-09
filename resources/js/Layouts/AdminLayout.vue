<script setup>
import { Link } from "@inertiajs/vue3";
import HeaderComponent from "@/Components/Header.vue";
import FooterComponent from "@/Components/Footer.vue";
</script>

<template>
    <div class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
        <HeaderComponent />
        <div class="flex h-screen">
            <!-- Левая панель -->
            <aside class="w-64 bg-gray-800 text-white flex flex-col">
                <div class="p-4 font-bold text-lg border-b border-gray-700">
                    Панель администратора
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <Link :href="route('admin.about_me.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
                    Обо мне
                    </Link>
                    <Link :href="route('admin.work_experience.index')"
                        class="block py-2 px-4 rounded hover:bg-gray-700">
                    Опыт работы
                    </Link>
                    <Link :href="route('admin.users.index')" class="block py-2 px-4 rounded hover:bg-gray-700">
                    Пользователи
                    </Link>
                    <Link href="/telescope" class="block py-2 px-4 rounded hover:bg-gray-700">
                    Telescope
                    </Link>
                </nav>
            </aside>
            <main class="container mx-auto px-4 py-8 flex-grow">
                <slot />
            </main>
        </div>
        <FooterComponent />
    </div>
</template>

