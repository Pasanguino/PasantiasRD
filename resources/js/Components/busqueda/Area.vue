<template>
  <div class="container">
    <div class="circle" v-for="(item, index) in circleData" :key="index">
      <a :href="'/areas/' + item.id + '/vacancies'" class="circle-link">
        <div class="circle-content">
          <h3>{{ item.area_name }}</h3>
          <p>{{ item.vacancies_count }}</p>
        </div>
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
  padding: 20px;
  justify-items: center; /* Centrando los items en el contenedor */
}

.circle {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 170px;
  height: 170px;
  border-radius: 50%;
  background: linear-gradient(135deg, #7d98f8, #a4c2f4);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  text-align: center;
  transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
}

.circle-link {
  color: inherit;
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  padding: 20px;
  transition: color 0.3s ease;
}

.circle:hover {
  background: linear-gradient(135deg, #f8724a, #fc9b6d);
  transform: scale(1.1);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.circle-link:hover {
  color: #fff;
}

.circle-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.circle:hover .circle-content {
  opacity: 0.9;
  transform: translateY(-5px);
}

.circle h3 {
  margin: 0;
  font-size: 1.2em;
  font-weight: 600;
  color: #fff;
  transition: color 0.3s ease;
}

.circle p {
  margin: 0;
  font-size: 2em;
  font-weight: 700;
  color: #fff;
  transition: color 0.3s ease;
}
</style>
