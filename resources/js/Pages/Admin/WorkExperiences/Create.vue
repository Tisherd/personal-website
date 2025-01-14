<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    company_name: "",
    position: "",
    start_date: "",
    end_date: "",
    technology_stack: "",
    desc: "",
});

const submit = () => {
    form.post(route("admin.work_experiences.store"));
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Добавить опыт работы</h1>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="company_name" class="block font-bold">Компания</label>
                <input v-model="form.company_name" id="company_name" type="text" class="input" />
            </div>
            <div class="mb-4">
                <label for="position" class="block font-bold">Должность</label>
                <input v-model="form.position" id="position" type="text" class="input" />
            </div>
            <div class="mb-4">
                <label for="start_date" class="block font-bold">Дата начала</label>
                <input v-model="form.start_date" id="start_date" type="date" class="input" />
            </div>
            <div class="mb-4">
                <label for="end_date" class="block font-bold">Дата окончания</label>
                <input v-model="form.end_date" id="end_date" type="date" class="input" />
            </div>
            <div class="mb-4">
                <label for="technology_stack" class="block font-bold">Технологии</label>
                <textarea v-model="form.technology_stack" id="technology_stack" class="input"></textarea>
            </div>
            <div class="mb-4">
                <label for="desc" class="block font-bold">Описание</label>
                <textarea v-model="form.desc" id="desc" class="input"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</template>
