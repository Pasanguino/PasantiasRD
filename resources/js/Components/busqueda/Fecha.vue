<template>

  <div class="container">
         <ProfileCard
      v-for="(vacancy, index) in vacancies"
      :key="vacancy.id"
      :id="vacancy.id"
      :vacancyName="vacancy.vacancy_name"
      :companyName="vacancy.company_name"
      :vacancyDescription="vacancy.vacancy_description"
      :salary="vacancy.salary"
      :imageSrc="'/images/favicon.ico'"
      :createdAt="vacancy.created_at"
      :company_id="vacancy.company_id"
      :user_id="vacancy.user_id"
      :province_id="vacancy.province.province_name"
      :area_id="vacancy.area.area_name"
      :position_id="vacancy.position.position_name"
    />
    <Nav :auth="auth"></Nav>
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
  /* max-height: 100vh; */

  padding: 20px;

}

.circle {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: #f5f5f5;
  border-radius: 50%;
  padding: 20px;
  text-align: center;
}
</style>
