<script setup>
import LeftPanel from "@/Components/LeftPanel.vue";

const links = [
    { href: route('sandbox.google_table_sync.index'), label: "Синхронизация с Google Table" },
];
</script>

<template>
    <LeftPanel title="Песочница" :links="links" />
</template>
