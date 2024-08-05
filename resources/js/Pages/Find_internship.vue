<template>

  <Head title="Encuentra Pasantias" />



  <Nav></Nav>


<br>

  <Titulos titulo="Encuentra Pasantias" />


  <main>
  <div class="Menu">
    <div class="container-left">
      <form class="max-w-md mx-auto" @submit.prevent="handleSearch">
        <label
          for="default-search"
          class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
        >
          Search
        </label>
        <div class="relative">
          <div
            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
          >
            <svg
              class="w-4 h-4 text-gray-500 dark:text-gray-400"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 20 20"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
              />
            </svg>
          </div>
          <input v-model="searchQuery"
            type="search"
            id="default-search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar..."
            required
          />
        </div>
      </form>
    </div>

    <div class="container-right">
      <SecondaryButton
        :class="{ active: activeButton === 'date' }"
        @click="setActiveButton('date')"
      >
        Vacantes por fecha de publicación
      </SecondaryButton>
      <SecondaryButton
        :class="{ active: activeButton === 'location' }"
        @click="setActiveButton('location')"
      >
        Vacantes por localización
      </SecondaryButton>
      <SecondaryButton
        :class="{ active: activeButton === 'vacancies' }"
        @click="setActiveButton('vacancies')"
      >
Vacantes por área
      </SecondaryButton>
    </div>
  </div>

  <div class="input-container">
    <div v-if="activeButton === 'date'">

<Publicacion/>

    </div>
    <div v-if="activeButton === 'location'"  class="overflow-y-scroll ss">
      <Vacantes />
    </div>
    <div v-if="activeButton === 'vacancies'" >
      <Area />
    </div>
  </div>
    </main>

  <!-- Footer ajustado sin posición absoluta -->
  <Footer />

</template>




<script setup>
import { ref } from "vue";
import { Head , router } from "@inertiajs/vue3";
import Titulos from "@/Components/Titulos.vue";
import SecondaryButton from "@/Components/PrimaryButton.vue";
import Area from "@/Components/busqueda/Area.vue";
import Footer from "@/Components/Footer.vue";
import Vacantes from '@/Components/Vacantes_provincias2.vue';
import Nav from "./Nav_student.vue";
import Publicacion from '@/Components/busqueda/Fecha.vue';


const activeButton = ref('date');

const setActiveButton = (button) => {
  activeButton.value = button;
};

const searchQuery = ref('');

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    router.get('/vacante/search/buscar', { buscar: searchQuery.value });
  }
  
  console.log("Search query submitted:", searchQuery.value);
};
</script>

<style scoped>
main {
  padding: 0 20px; 
}

.Menu {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 20px;
  align-items: start; 
  padding: 20px 0;
  height: auto; 
}

.container-left {
  grid-column: span 3; 
}

.container-right {
  grid-column: span 9; 
  display: flex;
  flex-wrap: wrap; 
  gap: 10px;
  justify-content: flex-start; 
  padding: 20px 0; 
}

.container-right button {
  background-color: #7d98f8;
  transition: 0.5s;
}

.container-right button:focus {
  background-color: #a54b07;
  transform: scale(1.1);
}

.secondary-button {
  background-color: lightgray;
  border: 1px solid transparent;
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.secondary-button.active {
  background-color: blue;
  color: white;
  border: none;
}

.input-container {
  margin: 20px 0 100px 0;
}

/* Estilos responsivos */
@media screen and (max-width: 768px) {
  .Menu {
    grid-template-columns: 1fr; 
    gap: 10px;
    padding: 10px 0;
  }

  .container-left {
    grid-column: span 12; 
    margin-bottom: 10px; 
  }

  .container-right {
    grid-column: span 12; 
    justify-content: center; 
  }

  .container-right button {
    width: 100%; 
    margin-bottom: 10px; 
  }
}

</style>