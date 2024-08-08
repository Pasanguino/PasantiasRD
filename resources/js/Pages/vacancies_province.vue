<template>
  <div>
    <h1>Vacancies in Province</h1>
    <ul>
      <li v-for="vacancy in vacancies" :key="vacancy.id">
        <strong>ID:</strong> {{ vacancy.id }}<br>
        <strong>Vacancy Name:</strong> {{ vacancy.vacancy_name }}<br>
        <strong>Description:</strong> {{ vacancy.vacancy_description }}<br>
        <strong>Salary:</strong> {{ vacancy.salary }}<br>
        <strong>Company Name:</strong> {{ vacancy.company_name }}<br>
        <strong>Company ID:</strong> {{ vacancy.company_id }}<br>
        <strong>User ID:</strong> {{ vacancy.user_id }}<br>
        <strong>Province ID:</strong> {{ vacancy.province_id }}<br>
        <strong>Area ID:</strong> {{ vacancy.area_id }}<br>
        <strong>Position ID:</strong> {{ vacancy.position_id }}<br>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    vacancies: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin-bottom: 1em;
}

strong {
  font-size: 1.2em;
}

em {
  font-style: normal;
  color: #555;
}
</style>
