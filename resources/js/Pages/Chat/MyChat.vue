<template>
  <Nav />
  <Titulos titulo="Mis Mensajes"></Titulos>
  <div class="p-6 space-y-4">
    <div
      v-for="chat in chats"
      :key="chat.id"
      class="bg-gray-100 rounded-lg shadow-md p-6 cursor-pointer hover:bg-gray-200 transition-colors duration-300"
    >
      <a :href="`/chat/${chat.id}`" class="block">
        <div class="flex flex-col space-y-2">
          <div>
            <h2 class="text-xl font-semibold text-gray-800">
              {{ chat.user1.first_name }} {{ chat.user1.last_name }}
            </h2>
            <p class="text-gray-600 text-sm">{{ chat.user1.company_name }}</p>
          </div>
          <div>
            <h2 class="text-xl font-semibold text-gray-800">
              {{ chat.user2.first_name }} {{ chat.user2.last_name }}
            </h2>
            <p class="text-gray-600 text-sm">{{ chat.user2.company_name }}</p>
          </div>
          <div class="mt-2 text-gray-500 text-xs">
            <p>Chat creado en: {{ formatDate(chat.created_at) }}</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <Footer />
</template>

<script setup>
import { ref, onMounted } from "vue";
import Titulos from "@/Components/Titulos.vue";
import Footer from "@/Components/Footer.vue";
import Nav from "@/Pages/Nav_student.vue";

// Define reactividad
const chats = ref([]);

// Define funciones
const fetchChats = async () => {
  try {
    const response = await fetch("/chats");
    chats.value = await response.json();
  } catch (error) {
    console.error("Error fetching chats:", error);
  }
};

const formatDate = (dateString) => {
  const options = {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
  };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

// Ejecuta la función al montar el componente
onMounted(() => {
  fetchChats();
});
</script>

<style scoped>
/* Agrega estilos personalizados aquí si es necesario */
</style>
