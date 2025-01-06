<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({});

const logout = () => {
    form.post(route('logout'));
};

const showDropdown = ref(false);
</script>

<template>
    <header class="bg-gray-600 text-white p-3 flex justify-between items-center">
        <!-- Левая часть: навигация -->
        <ul class="flex space-x-4 pl-20">
            <li>
                <Link :href="route('resume')">Резюме</Link>
            </li>
            <li>
                <Link href="#">Проекты</Link>
            </li>
            <li>
                <Link href="#">Песочница</Link>
            </li>
            <li>
                <Link href="#">Блог</Link>
            </li>
            <!-- <li>
                <a href="https://github.com/Tisherd/personal-website" target="_blank">Исходный код</a>
            </li> -->
            <li>
                <Link :href="route('admin.about_me.index')" class="ml-10">Админка</Link>
            </li>
        </ul>

        <!-- Правая часть: имя пользователя -->
        <div class="relative pr-20">
            <button class="text-white hover:underline" @click="showDropdown = !showDropdown">
                {{ $page.props.auth.user.login }}
            </button>

            <div v-if="showDropdown" class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg z-50">
                <ul>
                    <li>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-200" @click="logout">
                            Выйти
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <p v-if="$page.props.message"
        class="bg-indigo-600 h-10 flex items-center justify-center text-sm font-medium text-white px-4 sm:px-6 lg:px-8">
        {{ $page.props.message }}
    </p>
</template>
