<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";

</script>

<template>
    <MainLayout>
        <div class="flex h-screen">
            <!-- Левая панель -->
            <aside class="w-64 bg-gray-800 text-white flex flex-col">
                <div class="p-4 font-bold text-lg border-b border-gray-700">
                    Панель администратора
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <!-- <Link
                        :href="route('admin.about_me.index')"
                        class="block py-2 px-4 rounded hover:bg-gray-700"
                    >
                        Обо мне
                    </Link>
                    <Link
                        :href="route('admin.work_experience.index')"
                        class="block py-2 px-4 rounded hover:bg-gray-700"
                    >
                        Опыт работы
                    </Link> -->
                    <Link
                        :href="route('admin.users.index')"
                        class="block py-2 px-4 rounded hover:bg-gray-700"
                    >
                        Пользователи
                    </Link>
                </nav>
            </aside>

            <!-- Основной контент -->
            <main class="flex-1 p-6 bg-gray-100">
                <slot />
            </main>
        </div>
    </MainLayout>
</template>
