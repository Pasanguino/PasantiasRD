<template>
  <div>
    <Head title="Aplicaciones" />
    <Nav />
    <div class="w-full mt-6">
      <Titulos titulo="Vacantes postuladas" />
      <div class="w-full mx-auto p-8">
        <!-- Mostrar mensaje si no hay aplicaciones -->
        <div v-if="applications.length === 0" class="text-center py-8">
          <p class="text-lg text-gray-700">No se encontraron aplicaciones.</p>
        </div>
        <!-- Mostrar aplicaciones si existen -->
        <div v-else class="flex flex-wrap -mx-4">
          <div
            v-for="application in applications"
            :key="application.application.id"
            class="w-full md:w-1/2 lg:w-1/3 px-4 mb-6"
          >
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
              <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                  {{ application.application.vacancy.vacancy_name }}
                </h1>
                <p class="text-gray-700 mb-4">
                  {{ application.application.vacancy.vacancy_description }}
                </p>
                <div class="flex items-center justify-between mb-4">
                  <p class="text-xl font-semibold text-green-600">
                    Salario: ${{ formatCurrency(application.application.vacancy.salary) }}
                  </p>
                  <p class="text-gray-600">
                    Empresa: {{ application.application.vacancy.company_name }}
                  </p>
                </div>
                <div class="flex flex-wrap mb-4">
                  <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mr-2 mb-2">
                    Área: {{ application.application.vacancy.area_name }}
                  </p>
                  <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mr-2 mb-2">
                    Puesto: {{ application.application.vacancy.position_name }}
                  </p>
                  <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mb-2">
                    Provincia: {{ application.application.vacancy.province_name }}
                  </p>
                </div>
                <p class="text-gray-600 mb-4">
                  Estado:
                  <span
                    :class="
                      statusClass(application.application.status) + ' font-extrabold'
                    "
                  >
                    <strong>{{ application.application.status }}</strong>
                  </span>
                </p>
                <p class="text-gray-600 mb-4">
                  Nombre del Usuario: {{ application.application.user.first_name }}
                  {{ application.application.user.last_name }}
                </p>
                <div class="text-center">
                  <button
                    @click="viewApplication(application.application.id)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition"
                  >
                    Ver Detalles
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Footer></Footer>
</template>

<script setup>
import { defineProps } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import Nav from "./Nav.vue";
import Footer from "@/Components/Footer.vue";
import Titulos from "@/Components/Titulos.vue";

const props = defineProps({
  applications: Array,
});

function formatCurrency(amount) {
  return new Intl.NumberFormat("es-DO", { style: "currency", currency: "DOP" }).format(
    amount
  );
}

function statusClass(status) {
  switch (status) {
    case "aceptado":
      return "text-green-600";
    case "rechazado":
      return "text-red-600";
    case "en proceso":
      return "text-yellow-600";
    default:
      return "text-gray-600";
  }
}

function viewApplication(id) {
  // Función para manejar la visualización de los detalles de la aplicación
}
</script>
<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>
