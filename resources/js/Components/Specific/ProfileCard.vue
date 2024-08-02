<template>
  <div class="profile-card">
    <div class="flex justify-end px-4 pt-4"></div>
    <div class="flex flex-col items-center pb-10">
      <a :href="'/vacante/' + id">
        <img
          class="w-24 h-24 mb-3 rounded-full shadow-lg"
          :src="imageSrc"
        />
      </a>
      <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
        <a :href="'/vacante/' + id">
          {{ vacancyName }}
        </a>
      </h5>
      <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ companyName }}
      </span>
      <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ formattedDate }}
      </span>
      <div class="flex mt-4 md:mt-6">
        <button
          @click="applyForVacancy"
          class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Aplicar
        </button>
        <button 
          @click="toggleFavorite"
          class=" m-1 inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-400 dark:hover:bg-red-500 dark:focus:ring-red-600"
        >
       guardar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, computed, ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

// Props del componente
const props = defineProps({
  id: Number,
  vacancyName: String,
  companyName: String,
  createdAt: String,
  imageSrc: {
    type: String,
    default: '/images/favicon.ico',
  }
});

// Estado de autenticación y datos del usuario
const isAuthenticated = ref(false);
const userId = ref(null);

// Verifica el estado de autenticación y obtiene los datos del usuario al montar el componente
const checkAuthentication = async () => {
  try {
    const response = await axios.get('/auth/status');
    isAuthenticated.value = response.data.authenticated;

    if (isAuthenticated.value) {
      // Obtener datos del usuario si está autenticado
      const userResponse = await axios.get('/user');
      userId.value = userResponse.data.id;
    }
  } catch (error) {
    console.error('Error checking authentication status:', error);
  }
};

// Funciones para redirigir al usuario a la página de registro o inicio de sesión
const redirectToRegister = () => {
  window.location.href = '/register';
};

const redirectToLogin = () => {
  window.location.href = '/login';
};

// Función para aplicar a una vacante
const applyForVacancy = async () => {
  await checkAuthentication(); // Verifica la autenticación antes de proceder

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
        redirectToRegister();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        redirectToLogin();
      }
    });
    return;
  }

  try {
    const response = await axios.post('/applications', {
      vacancy_id: props.id,
    });

    Swal.fire({
      title: '¡Éxito!',
      text: response.data.message || '¡Vacante aplicada exitosamente!',
      icon: 'success',
      confirmButtonText: 'OK',
      cancelButtonText: 'Ir a Postulacion',
      showCancelButton: true,
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        console.log('¡Vacante aplicada exitosamente!');
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        window.location.href = '/applications';
      }
    });
  } catch (error) {
    Swal.fire({
      title: '¡Error!',
      text: error.response?.data.message || 'Hubo un error al enviar tu aplicación.',
      icon: 'error',
      confirmButtonText: 'OK',
      cancelButtonText: 'Ver postuladas',
      showCancelButton: true,
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.reload();
      } else if (result.isDismissed) {
        window.location.href = '/applications';
      }
    });
  }
};

// Función para agregar a favoritos
const toggleFavorite = async () => {
  await checkAuthentication(); // Verifica la autenticación antes de proceder

  if (!isAuthenticated.value) {
    Swal.fire({
      title: '¡Necesitas estar registrado!',
      text: 'Por favor, regístrate o inicia sesión para agregar a favoritos.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Registrarse',
      cancelButtonText: 'Iniciar sesión'
    }).then((result) => {
      if (result.isConfirmed) {
        redirectToRegister();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        redirectToLogin();
      }
    });
    return;
  }

  try {
    const response = await axios.post('/favorites', {
      user_id: userId.value, // Usa el ID del usuario
      vacancy_id: props.id,
    });

    Swal.fire({
      title: '¡Éxito!',
      text: response.data.message || '¡Vacante añadida a favoritos!',
      icon: 'success',
      confirmButtonText: 'OK'
    });
  } catch (error) {
    Swal.fire({
      title: '¡Error!',
      text: error.response?.data.message || 'Hubo un error al añadir la vacante a favoritos.',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  }
};

// Formatear la fecha
const formattedDate = computed(() => {
  return new Date(props.createdAt).toLocaleDateString();
});

// Llama a checkAuthentication al montar el componente
onMounted(() => {
  checkAuthentication();
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
