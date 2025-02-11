<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useInfiniteScroll } from '@vueuse/core';
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    blogs: Object
});

const blogs = reactive(props.blogs);

const loadMore = async () => {
    if (blogs.next_page_url) {
        try {
            const nextPageUrl = new URL(blogs.next_page_url);
            const nextPage = nextPageUrl.searchParams.get('page');

            const response = await axios.get(route('blogs.infinite', { page: nextPage }));

            blogs.data.push(...response.data.data);
            blogs.next_page_url = response.data.next_page_url;
        } catch (error) {
            console.error('Ошибка загрузки данных:', error);
        }
    }
};

useInfiniteScroll(window, loadMore);

const newMessage = ref('');

const submitBlog = () => {
    if (newMessage.value.trim()) {
        router.post(route('blogs.store'), { message: newMessage.value }, {
            onSuccess: (page) => {
                newMessage.value = '';
                blogs.data.unshift(page.props.blogs.data[0]); // Добавляем новый блог в начало
            }
        });
    }
};

const deleteBlog = (id) => {
    router.delete(route('blogs.destroy', id), {
        onSuccess: () => {
            blogs.data = blogs.data.filter(blog => blog.id !== id);
        }
    });
};
</script>

<template>
    <MainLayout>
        <div class="max-w-2xl mx-auto mt-8 space-y-6">
            <!-- New Blog Form -->
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <textarea v-model="newMessage" placeholder="Write your message..."
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"></textarea>
                <button @click="submitBlog" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Добавить
                </button>
            </div>

            <!-- Blog List -->
            <div v-for="blog in blogs.data" :key="blog.id" class="bg-white p-4 rounded-2xl shadow-md relative">
                <p class="text-lg">{{ blog.message }}</p>
                <div class="text-sm text-gray-500 mt-2 flex justify-between items-center">
                    <span>{{ new Date(blog.created_at).toLocaleString() }}</span>
                    <span>By {{ blog.user?.name || 'Deleted User' }}</span>
                </div>
                <button v-if="$page.props.auth.user.is_admin || blog.user?.id === $page.props.auth.user.id"
                    @click="deleteBlog(blog.id)" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                    Delete
                </button>
            </div>
        </div>
    </MainLayout>
</template>
