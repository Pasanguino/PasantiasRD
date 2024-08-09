<template>
  <Head title="Search" />
  <Nav :auth="auth"></Nav>

  <div class="container mx-auto p-4">
    <div class="search-container mb-8">
      <form @submit.prevent="handleSearch" class="search-form max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
        <label for="default-search" class="block text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
        <div class="relative flex items-center">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0z"/>
            </svg>
          </div>
          <input v-model="searchQuery" type="search" id="default-search" class="block w-full pl-12 pr-4 py-3 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar empleo..." required />
          <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <span class="sr-only">Buscar</span>
            <svg class="w-6 h-6  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0z"/>
            </svg>
          </button>
        </div>
      </form>
    </div>

    <div class="vacancies-container">
      <Titulos :titulo="'Vacantes de ' + entrada" />

      <div class="grid-container">
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
      </div>
      <div v-if="!vacancies.length" class="mt-6 text-center text-gray-600">
        <p>No se encontraron vacantes.</p>
      </div>
    </div>
  </div>

  <Footer />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Nav from './Nav_student.vue';
import Titulos from '@/Components/Titulos.vue';
import ProfileCard from '@/Components/Specific/ProfileCard.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  auth: {
    type: Object,
    required: true
  },
  vacancies: {
    type: Array,
    required: true
  },
  entrada: {
    type: String,
    required: true
  }
});

const searchQuery = ref('');

onMounted(() => {
  searchQuery.value = props.entrada;
});

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    router.get('/vacante/search/buscar', { buscar: searchQuery.value });
  }
  
  console.log("Search query submitted:", searchQuery.value);
};
</script>


<style scoped>

.container {
  max-width: 1200px;
}

.search-container {
  margin-top: 50px;
}

.search-form {
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
}

input[type="search"] {
  padding-left: 3rem;
  padding-right: 4rem;
  font-size: 1rem;
}

input::placeholder {
  color: #9ca3af;

}


button {
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 0.375rem;
  padding: 0.5rem 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

button svg{
  color: rgb(255, 255, 255);
}

button:hover {
  background-color: #0056b3;
    color: rgb(255, 255, 255);
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  width: 100%;
  justify-items: center;
  align-items: start;
}

.vacancies-container {
  padding: 20px;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  border-bottom: 1px solid #e5e5e5;
  padding: 10px;
  margin-bottom: 10px;
}
</style>
