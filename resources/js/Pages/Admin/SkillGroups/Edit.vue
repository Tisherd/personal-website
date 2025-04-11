<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from '@/Components/Base/InputLabel.vue';
import InputError from '@/Components/Base/InputError.vue';
import PrimaryButton from '@/Components/Base/PrimaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    skill_group: Object,
});

const form = useForm({
    name: props.skill_group.name,
    sort: props.skill_group.sort,
});

const update = () => {
    form.put(route('admin.skill_groups.update', props.skill_group.id));
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col items-center justify-center mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Редактировать пользователя
                </h1>

                <Link :href="route('admin.skill_groups.index')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
                    Вернуться назад
                </Link>
            </div>

            <form @submit.prevent="update" class="w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <InputLabel value="Название" />
                            <input :class="{ 'border-red-500': form.errors.name }" v-model="form.name" type="text"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel value="Сортировка" />
                            <input :class="{ 'border-red-500': form.errors.sort }" v-model="form.sort" type="number"
                                min="0"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                            <InputError class="mt-2" :message="form.errors.sort" />
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Обновить
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
