<template>
  <div class="container">

    <div class="circle" v-for="(data, index) in circleData" :key="index">
      <a href="#">
      <h3>{{ data.title }}</h3>
      <p>{{ data.vacancies }}</p>
</a>
    </div>

  </div>
</template>

<script setup>
import { ref } from "vue";

const circleData = ref([
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
  { title: "Frontend Developer", vacancies: 5 },
  { title: "Backend Developer", vacancies: 3 },
  { title: "UI/UX Designer", vacancies: 2 },
  { title: "Project Manager", vacancies: 1 },
]);

const updateVacancies = (index, newVacancies) => {
  circleData.value[index].vacancies = newVacancies;
};
</script>

<style scoped>
.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 30px;
  grid-auto-rows: min-content;
  max-height: 50vh;
  overflow-y: auto;
  padding: 20px;
}

.circle {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background-color: #7d98f8;
  text-align: center;
  transition: 0.3s;
}

.circle:hover{
  background-color: #f8724a;
  cursor: pointer;
  transform: scale(1.1);
}

.circle h3 {
  margin: 0;
  font-size: 1.2em;
}

.circle p {
  margin: 0;
  font-size: 2em;
}
</style>
