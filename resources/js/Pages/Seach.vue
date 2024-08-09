<template>
  <Head title="Search" />
  <Nav></Nav>

  <div class="search-container">
    <form @submit.prevent="handleSearch" class="search-form max-w-md mx-auto">
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input v-model="searchQuery" type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Empleo Pasantia ..."  required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
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
