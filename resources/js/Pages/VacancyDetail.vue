<template>
  <div>
    <h1>Detalles de Vacantes</h1>
    <div v-if="vacancies.length > 0">
      <div v-for="vacancy in vacancies" :key="vacancy.id" class="vacancy-item">
        <h2>{{ vacancy.vacancy_name }}</h2>
        <p>{{ vacancy.vacancy_description }}</p>
        <p><strong>Salario:</strong> ${{ vacancy.salary }}</p>
        <p><strong>Empresa:</strong> {{ vacancy.company_name }}</p>
        <p><strong>Ubicación:</strong> {{ getLocation(vacancy.province_id) }}</p>
        <p><strong>Puesto:</strong> {{ getPosition(vacancy.position_id) }}</p>
      </div>
    </div>
    <div v-else>
      <p>No hay vacantes disponibles.</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    vacancies: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    getLocation(provinceId) {
      // Implementar la lógica para obtener el nombre de la provincia
      // Ejemplo: return this.provinces.find(p => p.id === provinceId)?.name || 'Desconocida';
    },
    getPosition(positionId) {
      // Implementar la lógica para obtener el nombre del puesto
      // Ejemplo: return this.positions.find(p => p.id === positionId)?.name || 'Desconocido';
    }
  }
}
</script>

<style scoped>
.vacancy-item {
  margin-bottom: 20px;
}
</style>
