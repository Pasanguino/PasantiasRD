<template>
  <div class="container">
    <ProfileCard
      v-for="(vacancy, index) in vacancies"
      :key="index"
      :id="vacancy.id"
      :vacancyName="vacancy.vacancy_name"
      :companyName="vacancy.company_name"
      :createdAt="vacancy.created_at"
      :imageSrc="'/images/favicon.ico'"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ProfileCard from '@/Components/Specific/ProfileCard.vue';

const vacancies = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('/vacancies_data');
    vacancies.value = response.data;
  } catch (error) {
    console.error('Error fetching vacancies:', error);
  }
});
</script>

<style scoped>
.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  max-height: 100vh;
  overflow-y: auto;
  padding: 20px;
}
</style>
