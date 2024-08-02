<template>
  <Head :title="vacancy.vacancy_name" />
  <Nav></Nav>
<div class="w-full tt">
  <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-6">
    <div class="p-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ vacancy.vacancy_name }}</h1>
      <p class="text-gray-700 mb-6">{{ vacancy.vacancy_description }}</p>
      <div class="flex items-center justify-between mb-4">
        <p class="text-xl font-semibold text-green-600">Salario: ${{ formatCurrency(props.vacancy.salary) }}</p>
        <p class="text-gray-600">Empresa: {{ vacancy.company_name }} (ID: {{ vacancy.company_id }})</p>
      </div>
      <div class="flex flex-wrap mb-6">
        <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mr-2 mb-2">Área: {{ vacancy.areas ? vacancy.areas.area_name : 'No disponible' }}</p>
        <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mr-2 mb-2">Puesto: {{ vacancy.positions ? vacancy.positions.position_name : 'No disponible' }}</p>
        <p class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full mb-2">Provincia: {{ vacancy.provinces ? vacancy.provinces.province_name : 'No disponible' }}</p>
      </div>
      <p class="text-gray-600 mb-6">Favoritos: {{ vacancy.favorites.length ? vacancy.favorites.length : 'Ninguno' }}</p>
      <div class="text-center">
        <button @click="applyForVacancy" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
          Postularse
        </button>
      </div>
    </div>
  </div>
</div>


  <Footer></Footer>
</template>

<script setup>
import { defineProps, ref } from 'vue'
import { Head } from '@inertiajs/inertia-vue3'
import Nav from './Nav.vue'
import Footer from '@/Components/Footer.vue'
import axios from 'axios'
import Swal from 'sweetalert2'

const props = defineProps({
  vacancy: Object
})

const formatCurrency = (amount) => {
  if (isNaN(amount)) return 'RD$0.00';
  return `RD$${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
}


const isAuthenticated = ref(false)

const checkAuthentication = async () => {
  try {
    const response = await axios.get('/auth/status')
    isAuthenticated.value = response.data.authenticated
  } catch (error) {
    console.error('Error checking authentication status:', error)
  }
}

const redirectToRegister = () => {
  window.location.href = '/register'
}

const redirectToLogin = () => {
  window.location.href = '/login'
}

const applyForVacancy = async () => {
  await checkAuthentication() // Verifica la autenticación antes de proceder

  if (!isAuthenticated.value) {
    Swal.fire({
      title: '¡Necesitas estar registrado!',
      text: 'Por favor, regístrate o inicia sesión para aplicar a una vacante.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Registrarse',
      cancelButtonText: 'Iniciar sesión'
    }).then((result) => {
      if (result.isConfirmed) {
        redirectToRegister()
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        redirectToLogin()
      }
    })
    return
  }

  try {
    const response = await axios.post('/applications', {
      vacancy_id: props.vacancy.id,
    })
Swal.fire({
  title: '¡Éxito!',
  text: response.data.message || '¡Aplicación enviada exitosamente!',
  icon: 'success',
  confirmButtonText: 'OK',
  showCancelButton: true,
  cancelButtonText: 'Ir a enlace',
  preConfirm: (isConfirm) => {
    if (!isConfirm) {
      // Aquí puedes definir la URL a la que se redirigirá el usuario
      window.location.href = 'https://ejemplo.com';
    }
  }
});
  } catch (error) {
    Swal.fire({
      title: '¡Error!',
      text: error.response?.data.message || 'Hubo un error al enviar tu aplicación.',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  }
}
</script>

<style scoped>

.tt {

margin: 120px 0;

  
}


</style>
