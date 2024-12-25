<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

defineProps({
    users: Array,
});
</script>

<template>
    <MainLayout>
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Login</th>
                    <th class="border border-gray-300 px-4 py-2">Role</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td class="border border-gray-300 px-4 py-2">{{ user.login }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ user.role }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ user.desc }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <Link :href="`/users/${user.id}/edit`" class="text-blue-500 hover:underline">Edit</Link>
                        <form
                            :action="`/users/${user.id}`"
                            method="POST"
                            class="inline-block ml-2"
                        >
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="text-red-500 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </MainLayout>
</template>
