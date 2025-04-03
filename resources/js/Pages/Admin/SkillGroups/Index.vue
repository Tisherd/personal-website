<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CrudTable from "@/Components/CrudTable.vue";

defineProps({
    skill_groups: Object,
});

const headers = [
    { key: "name", label: "Название" },
    { key: "sort", label: "Сортировка" },
];

const routes = {
    create: "admin.skill_groups.create",
    edit: "admin.skill_groups.edit",
    delete: "admin.skill_groups.destroy",
};
</script>

<template>
    <AdminLayout>
        <CrudTable
            :headers="headers"
            headerTitle="Группа навыков"
            :items="skill_groups.data"
            :links="skill_groups.links"
            :routes="routes"
        />
    </AdminLayout>
</template>
