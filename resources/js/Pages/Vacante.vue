<template>
  <div>
    <h1>{{ vacancy.vacancy_name }}</h1>
    <p>{{ vacancy.vacancy_description }}</p>
    <p>Salary: ${{ vacancy.salary }}</p>
    <p>Company: {{ vacancy.company_name }} (ID: {{ vacancy.company_id }})</p>
    <p>Area: {{ vacancy.areas ? vacancy.areas.area_name : 'N/A' }}</p>
    <p>Position: {{ vacancy.positions ? vacancy.positions.position_name : 'N/A' }}</p>
    <p>Province: {{ vacancy.provinces ? vacancy.provinces.province_name : 'N/A' }}</p>
    <p>Favorites: {{ vacancy.favorites.length ? vacancy.favorites.length : 'None' }}</p>
  </div>
</template>

<script>
export default {
  props: {
    vacancy: Object
  }
}
</script>
