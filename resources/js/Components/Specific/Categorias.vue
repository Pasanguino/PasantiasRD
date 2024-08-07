<template>
  <div class="container mx-auto my-8 px-4">
    <h1 class="title">
      Todas las áreas disponibles en RD
    </h1>
    <div class="flex flex-wrap justify-center gap-6 mt-20 p-4">
      <div v-for="area in areas" :key="area.id" 
           @click="redirectToVacancies(area.id)"
           class="category bg-gray-700 text-white rounded-full py-3 px-6 text-lg cursor-pointer hover:bg-gray-600 transition">
        {{ area.area_name }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Categories',
  data() {
    return {
      areas: []
    };
  },
  mounted() {
    this.fetchAreas();
  },
  methods: {
    async fetchAreas() {
      try {
        const response = await axios.get('/Area');
        this.areas = response.data;
      } catch (error) {
        console.error('Error fetching areas:', error);
      }
    },
    redirectToVacancies(id) {
      window.location.href = `/areas/${id}/vacancies`;
    }
  }
};
</script>

<style scoped>
.title {
  text-align: center;
  font-size: 3rem; /* Tamaño grande del texto */
  font-weight: bold;

  position: relative;
  margin: 100px 0;
}

.title::after {
  content: '';
  display: block;
  width: 30%;
  height: 4px;
  background-color: #1D4ED8; /* Azul */
  margin: 0 auto;
  position: absolute;
  bottom: -10px; /* Ajusta la distancia entre el texto y la línea */
  left: 50%;
  transform: translateX(-50%);
}
</style>
