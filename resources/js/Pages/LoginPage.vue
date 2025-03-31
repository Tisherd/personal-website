<script setup>
import InputError from '@/Components/Base/InputError.vue';
import InputLabel from '@/Components/Base/InputLabel.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import TextInput from '@/Components/Base/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    login: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen flex flex-col justify-center bg-gray-100">
        <div class="flex flex-col items-center py-8 px-4 sm:px-6 lg:px-8">
            <!-- Форма логина -->
            <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Войти в систему</h2>

                <form @submit.prevent="submit">
                    <!-- Логин -->
                    <div>
                        <InputLabel for="login" value="Логин" />
                        <TextInput id="login" type="text" class="mt-1 block w-full" v-model="form.login" required autofocus autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.login" />
                    </div>

                    <!-- Пароль -->
                    <div class="mt-4">
                        <InputLabel for="password" value="Пароль" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Кнопка входа -->
                    <div class="mt-6">
                        <PrimaryButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Войти
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <!-- Описание -->
            <div class="lg:mt-12 mt-10 w-full max-w-md bg-white p-6 rounded-lg shadow-md border border-gray-200 text-center text-gray-600">
                <h3 class="text-xl font-semibold text-gray-800">Описание сайта</h3>
                <p class="mt-2">Это мой личный сайт, который преимущественно использую в своих целях познания веб-программирования.</p>
                <p class="mt-2">Но в нем есть различные разделы. Наверно самый полезный - это проекты. В нем я буду добавлять и разворачивать различные проекты для демонстрации.</p>
            </div>
        </div>
    </div>
</template>
