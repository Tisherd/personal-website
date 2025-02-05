<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useInfiniteScroll } from '@vueuse/core';

const { props } = usePage();
const blogs = ref(props.blogs.data);
const nextPageUrl = ref(props.blogs.next_page_url);
const newMessage = ref('');

console.log(props);

const loadMore = async () => {
    if (nextPageUrl.value) {
        const response = await axios.get(nextPageUrl.value);
        blogs.value.push(...response.data.data);
        nextPageUrl.value = response.data.next_page_url;
    }
};

useInfiniteScroll(window, loadMore);

const submitBlog = () => {
    if (newMessage.value.trim()) {
        router.post('/blogs', { message: newMessage.value }, {
            onSuccess: () => newMessage.value = ''
        });
    }
};

const deleteBlog = (id) => {
    router.delete(`/blogs/${id}`);
};
</script>

<template>
    <MainLayout>
        <div class="max-w-2xl mx-auto mt-8 space-y-6">
            <!-- New Blog Form -->
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <textarea v-model="newMessage" placeholder="Write your blog..."
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"></textarea>
                <button @click="submitBlog" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Submit
                </button>
            </div>

            <!-- Blog List -->
            <div v-for="blog in blogs" :key="blog.id" class="bg-white p-4 rounded-2xl shadow-md relative">
                <p class="text-lg">{{ blog.message }}</p>
                <div class="text-sm text-gray-500 mt-2 flex justify-between items-center">
                    <span>{{ new Date(blog.created_at).toLocaleString() }}</span>
                    <span>By {{ blog.user.name }}</span>
                </div>
                <button v-if="blog.user.id === props.auth.user?.id" @click="deleteBlog(blog.id)"
                    class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                    Delete
                </button>
            </div>
        </div>
    </MainLayout>
</template>
