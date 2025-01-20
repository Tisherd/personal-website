<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CrudTable from "@/Components/CrudTable.vue";

defineProps({
    workExperiences: Object,
});

const headers = [
    { key: "company_name", label: "Компания" },
];

const routes = {
    create: "admin.work_experiences.create",
    edit: "admin.work_experiences.edit",
    delete: "admin.work_experiences.destroy",
};
</script>

<template>
    <AdminLayout>
        <CrudTable
            :headers="headers"
            headerTitle="Опыт работы"
            :items="workExperiences.data"
            :links="workExperiences.links"
            :routes="routes"
        />
    </AdminLayout>
</template>

