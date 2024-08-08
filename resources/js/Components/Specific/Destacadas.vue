<template>
  <div class="featured-companies py-8 bg-gray-100 caja">
    <h1 class="text-3xl font-bold text-center text-blue-900 mb-8">Empresas Destacadas</h1>
    <div class="companies-container flex flex-wrap justify-center gap-6">
      <div v-for="company in companies.slice(0, 5)" :key="company.id" class="company-card bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 rounded-lg shadow-xl p-6 flex-none w-72 transition-transform transform hover:scale-105 hover:shadow-2xl">
        <h2 class="text-xl font-semibold text-white mb-2">{{ company.company_name }}</h2>
        <p class="text-white mb-2">Fecha de Creación: {{ formatDate(company.created_at) }}</p>
        <p class="text-white">Provincia: {{ getProvinceName(company.province_id) }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      companies: [],
      provinces: [],
    };
  },
  async mounted() {
    await Promise.all([this.fetchCompanies(), this.fetchProvinces()]);
  },
  methods: {
    async fetchCompanies() {
      try {
        const response = await axios.get('/companies');
        this.companies = response.data;
      } catch (error) {
        console.error('Error fetching companies:', error);
      }
    },
    async fetchProvinces() {
      try {
        const response = await axios.get('/province-data');
        this.provinces = response.data;
      } catch (error) {
        console.error('Error fetching provinces:', error);
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
    getProvinceName(provinceId) {
      const province = this.provinces.find(p => p.province_id === provinceId);
      return province ? province.province_name : 'Desconocida';
    },
  },
};
</script>

<style scoped>

h1{
    font-size: 40px;
    margin-bottom: 50px;
}
</style>
