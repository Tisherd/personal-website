<!-- MainLayout.vue -->
<template>
    <div>
        <HeaderComponent /> <!-- Шапка сайта -->
        <main>
            <slot /> <!-- Место для динамического контента -->
        </main>
        <FooterComponent /> <!-- Подвал сайта -->
    </div>
</template>

<script>
import HeaderComponent from "../Components/Header.vue";
import FooterComponent from "../Components/Footer.vue";

export default {
    components: {
        HeaderComponent,
        FooterComponent,
    },
};
</script>

<!-- <style>
main {
    padding: 20px;
}
</style> -->
