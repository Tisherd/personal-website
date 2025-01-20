<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CrudTable from "@/Components/CrudTable.vue";

defineProps({
    users: Object,
});

const headers = [
    { key: "login", label: "Логин" },
    { key: "name", label: "Имя" },
    { key: "role.title", label: "Роль" },
    { key: "desc", label: "Описание" },
];

const routes = {
    create: "admin.users.create",
    edit: "admin.users.edit",
    delete: "admin.users.destroy",
};
</script>

<template>
    <AdminLayout>
        <CrudTable
            :headers="headers"
            headerTitle="Пользователи"
            :items="users.data"
            :links="users.links"
            :routes="routes"
        />
    </AdminLayout>
</template>
