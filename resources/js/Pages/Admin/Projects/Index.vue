<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CrudTable from "@/Components/CrudTable.vue";

defineProps({
    projects: Object,
});

const headers = [
    { key: "title", label: "Проект" },
    { key: "description", label: "Описание" },
];

const routes = {
    create: "admin.projects.create",
    edit: "admin.projects.edit",
    delete: "admin.projects.destroy",
};
</script>

<template>
    <AdminLayout>
        <CrudTable
            :headers="headers"
            headerTitle="Проекты"
            :items="projects.data"
            :links="projects.links"
            :routes="routes"
        />
    </AdminLayout>
</template>
