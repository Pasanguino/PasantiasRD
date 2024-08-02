<template>
  <main>
  <Head title="Encuentra Pasantias" />



  <Nav></Nav>



  <Titulos titulo="Encuentra Pasantias" />



  <div class="Menu">
    <div class="container-left">
      <form class="max-w-md mx-auto">
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
          <input
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
        <h2 class="text-xl font-bold mb-4">Vacantes por Fecha de Publicación</h2>
        <div v-for="vacante in vacantesPorFecha" :key="vacante.id" class="vacante-item">
          <h3 class="text-lg font-semibold">{{ vacante.titulo }}</h3>
          <p class="text-sm text-gray-600">{{ vacante.fechaPublicacion }}</p>
          <p>{{ vacante.descripcion }}</p>
          <img :src="vacante.imagen" alt="Imagen de la vacante" class="vacante-image" />
        </div>
      </div>
      <div v-if="activeButton === 'location'" class="overflow-y-scroll ss">
        <Vacantes />
      </div>
      <div v-if="activeButton === 'vacancies'">
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
import Nav from "./Nav.vue";
import Publicacion from '@/Components/busqueda/Fecha.vue';

const activeButton = ref('date');
const vacantesPorFecha = ref([
  { id: 1, titulo: 'Desarrollador Frontend', fechaPublicacion: '2024-07-31', descripcion: 'Buscamos un desarrollador con experiencia en Vue.js.', imagen: 'ruta/a/la/imagen1.jpg' },
  { id: 2, titulo: 'Diseñador UX/UI', fechaPublicacion: '2024-07-29', descripcion: 'Diseñador con experiencia en diseño de interfaces.', imagen: 'ruta/a/la/imagen2.jpg' },
  { id: 3, titulo: 'Ingeniero de Software', fechaPublicacion: '2024-07-30', descripcion: 'Buscamos ingeniero con conocimientos en backend y frontend.', imagen: 'ruta/a/la/imagen3.jpg' },
  // Añadir más vacantes según sea necesario
]);

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
  padding: 0px 50px;
}
/* .ss{
  height: 100vh;
} */

.Menu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;

  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 20px; /* Espaciado entre columnas, opcional */
  height: 200px;
}

.container-left {
  grid-column: span 2;
}

.container-left input {
  width: 100%;
}
.container-right {
  grid-column: span 10;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 100px;
}

.container-right button {
  background-color: #7D98F8;
  transition: 0.5s;
}

.container-right button:focus {
  background-color: #A54B07;
  transform: scale(1.1);
}

.secondary-button {
  background-color: lightgray; /* Color por defecto */
  border: 1px solid transparent;
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.secondary-button.active {
  background-color: blue; /* Estilo para botón activo */
  color: white;
  border: none;
  outline: none;
}

.input-container {
  margin: 20px 0 100px 0;
}

/* Estilos adicionales para las vacantes */
.vacante-item {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 16px;
  background-color: #f9f9f9;
}

.vacante-image {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

h2 {
  color: #333;
}
</style>

