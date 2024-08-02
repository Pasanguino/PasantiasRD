<template>
  <div>
    <Head title="Aplicaciones" />
    <Nav />
    <div class="w-full mt-6">
      <Titulos titulo="Vacantes postuladas" />
      <div class="w-full mx-auto p-8">
        <!-- Mostrar mensaje flash si existe -->
        <div v-if="flashMessage" class="text-center py-8">
          <p class="text-lg text-gray-700">{{ flashMessage }}</p>
        </div>
        <!-- Mostrar mensaje si no hay aplicaciones -->
        <div v-if="applications.length === 0" class="text-center py-8">
          <p class="text-lg text-gray-700">No se encontraron aplicaciones.</p>
        </div>
        <!-- Mostrar aplicaciones si existen -->
        <div v-else class="flex flex-wrap -mx-4">
          <div
            v-for="application in applications"
            :key="application.id"
            class="w-full md:w-1/2 lg:w-1/3 px-4 mb-6"
          >
            <ProfileCard
              :id="application.vacancy.id"
              :vacancyName="application.vacancy.vacancy_name"
              :companyName="application.vacancy.company_name"
              :createdAt="application.vacancy.created_at"
              :imageSrc="application.vacancy.image_src"
            />
            <div class="text-center mt-4">
              <button
                @click="deleteFavorite(application.id)"
                class="bg-red-500 text-white px-6 py-3 rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition"
              >
                Quitar
              </button>
            </div>
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
import Nav from "./Nav.vue";
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
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>
