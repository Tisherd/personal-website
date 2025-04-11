<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="pl-20">
        <ul class="flex space-x-4">
            <li>
                <Link
                    :href="route('resume.about_me.index')"
                    class="px-3 py-2 rounded-md text-white transition duration-200 hover:bg-gray-700 hover:text-gray-300"
                >
                    Резюме
                </Link>
            </li>
            <li>
                <Link
                    :href="route('projects.index')"
                    class="px-3 py-2 rounded-md text-white transition duration-200 hover:bg-gray-700 hover:text-gray-300"
                >
                    Проекты
                </Link>
            </li>
            <li>
                <Link
                    :href="route('blogs.index')"
                    class="px-3 py-2 rounded-md text-white transition duration-200 hover:bg-gray-700 hover:text-gray-300"
                >
                    Блог
                </Link>
            </li>
            <li v-if="$page.props.auth.user.is_admin">
                <Link
                    :href="route('admin.about_me.index')"
                    class="ml-10 px-3 py-2 rounded-md text-white transition duration-200 hover:bg-gray-700 hover:text-gray-300"
                >
                    Админка
                </Link>
            </li>
        </ul>
    </nav>
</template>
