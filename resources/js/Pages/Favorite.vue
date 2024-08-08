<template>
  <div>
    <Head title="Aplicaciones" />
    <Nav />
    <div class="w-full mt-6">
      <Titulos titulo="Vacantes postuladas" />
      <div class="w-full mx-auto p-8">
        <!-- Mostrar mensaje flash si existe -->

        <!-- Mostrar mensaje si no hay aplicaciones -->
        <div v-if="applications.length === 0" class="text-center py-8">
          <p class="text-lg text-gray-700">No se encontraron aplicaciones.</p>
        </div>
        <!-- Mostrar aplicaciones si existen -->
        <div v-else class="flex flex-wrap -mx-4">
          <div
            v-for="application in applications"
            :key="application.id"
            class="relative w-full md:w-1/2 lg:w-1/3 px-4 mb-6"
          >
            <ProfileCard
              :id="application.vacancy.id"
              :vacancyName="application.vacancy.vacancy_name"
              :companyName="application.vacancy.company_name"
              :vacancyDescription="application.vacancy.vacancy_description"
              :salary="application.vacancy.salary"
              :imageSrc="'/images/favicon.ico'"
              :createdAt="application.vacancy.created_at"
              :company_id="application.vacancy.company_id"
              :user_id="application.vacancy.user_id"
              :province_id="application.vacancy.province.province_name"
              :area_id="application.vacancy.area.area_name"
              :position_id="application.vacancy.position.position_name"
            />
            <button
              @click="deleteFavorite(application.id)"
              class=" ff absolute  top-4 right-4 bg-red-500 text-white rounded-full p-3 shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition"
              aria-label="Eliminar favorito"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Footer></Footer>
</template>


<script setup>
import { defineProps, ref, watch } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import Nav from "./Nav_student.vue";
import Footer from "@/Components/Footer.vue";
import Titulos from "@/Components/Titulos.vue";
import ProfileCard from "@/Components/Specific/ProfileCard.vue"; // Asegúrate de importar el componente ProfileCard
import { Inertia } from "@inertiajs/inertia"; // Asegúrate de importar Inertia
import Swal from 'sweetalert2'; // Importa SweetAlert2

const props = defineProps({
  applications: Array,
  flash: Object, // Asegúrate de que flash sea pasado como prop
});

const flashMessage = ref(props.flash?.status || '');

function deleteFavorite(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esta aplicación será eliminada.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      Inertia.delete(`/favorites/${id}`, {
        onSuccess: () => {
          Swal.fire(
            'Eliminado!',
            'La aplicación ha sido eliminada.',
            'success'
          );
          // Redirigir a la misma página para recargar los datos
          Inertia.visit(window.location.href, {
            method: 'get',
            preserveState: true,
          });
        },
        onError: () => {
          Swal.fire(
            'Error!',
            'Hubo un error al eliminar la aplicación.',
            'error'
          );
        },
      });
    }
  });
}

watch(() => props.flash?.status, (newVal) => {
  flashMessage.value = newVal;
});
</script>


<style scoped>

.ff {
  font-family: 'Poppins', sans-serif;
  transform: translate(20px, -30px);
  z-index: 1000;
}
</style>
