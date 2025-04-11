<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CrudTable from "@/Components/CrudTable.vue";

const props = defineProps({
    skills: Object,
});

console.log(props.skills);

const headers = [
    { key: "name", label: "Название" },
    { key: "group.name", label: "Группа" },
    { key: "level", label: "Уровень" },
];

const routes = {
    create: "admin.skills.create",
    edit: "admin.skills.edit",
    delete: "admin.skills.destroy",
};
</script>

<template>
    <AdminLayout>
        <CrudTable
            :headers="headers"
            headerTitle="Навыки"
            :items="skills.data"
            :links="skills.links"
            :routes="routes"
        />
    </AdminLayout>
</template>
