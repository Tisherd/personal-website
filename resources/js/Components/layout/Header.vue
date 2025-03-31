<script setup>
import Navigation from './Navigation.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({});

const logout = () => {
    form.post(route('logout'));
};

const showDropdown = ref(false);
</script>

<template>
    <header class="bg-slate-600 text-white p-3 flex justify-between items-center">
        <!-- Левая часть: навигация -->
        <Navigation />

        <!-- Правая часть: имя пользователя -->
        <div class="relative pr-20">
            <button class="text-white hover:underline" @click="showDropdown = !showDropdown">
                {{ $page.props.auth.user.name }}
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
</template>
