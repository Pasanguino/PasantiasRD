<template>
  <div class="profile-card">
    <div class="flex justify-end px-4 pt-4"></div>
    <div class="flex flex-col items-center pb-10">
      <img
        class="w-24 h-24 mb-3 rounded-full shadow-lg"
        :src="imageSrc"
      />
      <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
        {{ vacancyName }}
      </h5>
      <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ companyName }}
      </span>
      <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ formattedDate }}
      </span>
      <div class="flex mt-4 md:mt-6">
        <a
          href="#"
          class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Aplicar
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';

const props = defineProps({
  vacancyName: String,
  companyName: String,
  createdAt: String,
  imageSrc: {
    type: String,
    default: '/images/favicon.ico',
  },
});

const formattedDate = computed(() => {
  return new Date(props.createdAt).toLocaleDateString();
});
</script>

<style scoped>
.profile-card {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  max-width: 300px; /* Limita el ancho máximo del perfil */
  background-color: white;
  border: 1px solid #e2e8f0;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 1rem;
}

.profile-card h5 {
  margin-bottom: 0.5rem;
  font-size: 1.5rem;
}

.profile-card p {
  margin-bottom: 1rem;
  font-size: 1.2rem;
  color: #4a5568;
}

.profile-card img {
  width: 100px;
  height: 100px;
  border-radius: 9999px; /* Asegura que la imagen sea redonda */
  object-fit: cover;
  border: 2px solid white;
  box-shadow: 0 0 0 2px #4299e1;
}
</style>
