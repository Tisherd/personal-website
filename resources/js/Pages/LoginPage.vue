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
    <div class="min-h-screen bg-gray-100">
        <div class="flex flex-col items-center pt-20 py-8 px-4 sm:px-6 lg:px-8">
            <!-- Форма логина -->
            <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Войти в систему</h2>

                <form @submit.prevent="submit">
                    <!-- Логин -->
                    <div>
                        <InputLabel for="login" value="Логин" />

                        <TextInput id="login" type="text" class="mt-1 block w-full" v-model="form.login" required
                            autofocus autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.login" />
                    </div>

                    <!-- Пароль -->
                    <div class="mt-4">
                        <InputLabel for="password" value="Пароль" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="current-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Кнопка входа -->
                    <div class="mt-6 flex items-center justify-end">
                        <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Войти
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <!-- Описание проекта (будет добавлено позже) -->
            <div class="mt-8 w-full max-w-md text-center text-gray-600">
                <h3 class="text-xl font-semibold">Описание проекта</h3>
                <p class="mt-2">Здесь будет описание вашего проекта. Добавьте текст позже.</p>
            </div>
        </div>
    </div>
</template>
