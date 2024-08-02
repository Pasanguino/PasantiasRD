<template>
  <div class="container">
    <div class="circle" v-for="(item, index) in circleData" :key="index">
      <a :href="'/areas/' + item.id + '/vacancies'">
      
        <h3>{{ item.area_name }}</h3>
        <p>{{ item.vacancies_count }}</p>
      </a>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const circleData = ref([]);

const fetchVacancies = async () => {
  try {
    const response = await axios.get("/vacancies_area");
    circleData.value = response.data;
  } catch (error) {
    console.error("Error fetching vacancies:", error);
  }
};

onMounted(() => {
  fetchVacancies();
});

const updateVacancies = (index, newVacancies) => {
  circleData.value[index].vacancies_count = newVacancies;
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

.circle:hover {
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
