<script setup>
import { ref } from 'vue';

const skills = ref([
  { name: 'JavaScript', level: 80 },
  { name: 'Vue.js', level: 75 },
  { name: 'PHP', level: 85 },
  { name: 'Laravel', level: 90 },
  { name: 'PostgreSQL', level: 70 },
  { name: 'CSS', level: 65 },
]);

// Функция для конвертации уровня в строку
const getLevelLabel = (level) => {
  if (level >= 90) return 'Expert';
  if (level >= 70) return 'Intermediate';
  return 'Beginner';
};
</script>

<template>
  <div class="skills-section">
    <h1 class="text-2xl font-semibold mb-6">Мои навыки</h1>
    <div v-for="skill in skills" :key="skill.name" class="skill-item mb-4">
      <div class="flex justify-between items-center">
        <span class="font-medium">{{ skill.name }}</span>
        <span class="text-sm text-gray-500">{{ getLevelLabel(skill.level) }}</span>
      </div>
      <div class="progress-bar mt-2 w-full bg-gray-200 rounded-full h-2">
        <div :style="{ width: skill.level + '%' }" class="bg-blue-500 h-2 rounded-full"></div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.skills-section {
  padding: 2rem;
}

.skill-item {
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
}

.progress-bar {
  background-color: #f3f4f6;
}
</style>
