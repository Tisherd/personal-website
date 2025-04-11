<script setup>
import ResumeLayout from "@/Layouts/ResumeLayout.vue";
import { defineProps, ref } from 'vue';

const props = defineProps({
    skillGroups: Array
});

const getLevelLabel = (level) => {
    if (level >= 90) return 'Expert';
    if (level >= 70) return 'Intermediate';
    return 'Beginner';
};

const visibleDescription = ref(null);

const toggleDescription = (skillId) => {
    visibleDescription.value = visibleDescription.value === skillId ? null : skillId;
};
</script>

<template>
    <ResumeLayout>
        <div class="flex flex-col items-center mt-8 px-4">
            <div v-for="group in skillGroups" :key="group.id" class="w-full max-w-5xl mb-12">
                <h2 class="text-2xl font-bold mb-6 border-b pb-2 px-4 text-gray-800">
                    {{ group.name }}
                </h2>
                <div class="flex flex-col gap-4 px-4">
                    <div
                        v-for="skill in group.skills"
                        :key="skill.id"
                        class="skill-item hover:bg-gray-50 transition-colors"
                        @click="toggleDescription(skill.id)"
                    >
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-lg">{{ skill.name }}</span>
                            <span class="text-sm text-gray-500">{{ getLevelLabel(skill.level) }}</span>
                        </div>

                        <div v-if="visibleDescription === skill.id" class="mt-4 space-y-2">
                            <div class="progress-bar w-full bg-gray-200 rounded-full h-2">
                                <div
                                    :style="{ width: skill.level + '%' }"
                                    class="bg-blue-500 h-2 rounded-full"
                                ></div>
                            </div>
                            <div class="p-3 bg-gray-50 rounded text-sm text-gray-700">
                                {{ skill.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ResumeLayout>
</template>

<style scoped>
.skill-item {
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 0.75rem; /* 12px для более округлых краёв */
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.skill-item:hover {
    background-color: #f9fafb;
}

.progress-bar {
    background-color: #f3f4f6;
}
</style>
