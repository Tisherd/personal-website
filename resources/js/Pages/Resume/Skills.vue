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
        <div class="flex flex-col mt-8">
            <div v-for="group in skillGroups" :key="group.id" class="mb-8 max-w-5xl">
                <h2 class="text-xl font-semibold ml-6">{{ group.name }}</h2>
                <div
                    v-for="skill in group.skills"
                    :key="skill.id"
                    class="skill-item mb-4 hover:bg-gray-100 transition-colors"
                    @click="toggleDescription(skill.id)"
                >
                    <div class="flex justify-between items-center">
                        <span class="font-medium">{{ skill.name }}</span>
                        <span class="text-sm text-gray-500">{{ getLevelLabel(skill.level) }}</span>
                    </div>

                    <!-- Description and progress bar -->
                    <div v-if="visibleDescription === skill.id" class="mt-4 space-y-2">
                        <div class="progress-bar w-full bg-gray-200 rounded-full h-2">
                            <div
                                :style="{ width: skill.level + '%' }"
                                class="bg-blue-500 h-2 rounded-full"
                            ></div>
                        </div>
                        <div class="p-2 bg-gray-50 rounded">
                            <p class="text-sm text-gray-700">{{ skill.description }}</p>
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
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.skill-item:hover {
    background-color: #f9fafb; /* светло-серый оттенок при наведении */
}

.progress-bar {
    background-color: #f3f4f6;
}
</style>
