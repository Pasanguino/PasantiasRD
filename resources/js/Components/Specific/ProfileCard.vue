<template>
  <div class="vacancy-card">

    <div class="image-section">
      <img :src="imageSrc" alt="Vacancy Image" class="vacancy-image"/>
    </div>
    <div class="details-section">
     <a :href="'/vacante/' + id">
      <h2 class="vacancy-title">{{ vacancyName }}</h2>
    </a>
      <p class="company-name">{{ companyName }}</p>
      <p class="salary">Salario: {{ salary | currency }}</p>
      <p class="location">
        <span>Provincia: {{ province_id }}</span>
        <span>Área: {{ area_id }}</span>
        <span>Posición: {{ position_id }}</span>
      </p>
      <p class="date">{{ formattedDate }}</p>
      <div class="button-group">
        <button @click="applyForVacancy" class="btn apply-btn">
          Aplicar
        </button>
        <button @click="toggleFavorite" class="btn favorite-btn">
          Favorito
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
  },
  vacancy_description: String,
  salary: Number,
  company_id: Number,
  user_id: Number,
  province_id: Number,
  area_id: Number,
  position_id: Number,
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
.vacancy-card {
  display: flex;
  flex-direction: column;
  max-width: 350px;
  border-radius: 1rem;
  overflow: hidden;
  background: #ffffff;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  width: 100%;
}

.vacancy-card:hover {
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.image-section {
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.vacancy-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.details-section {
  padding: 1.5rem;
  text-align: left;
}

.vacancy-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
  color: #333;
}

.company-name {
  font-size: 1.1rem;
  color: #666;
  margin: 0.5rem 0;
}

.salary {
  font-size: 1.1rem;
  color: #444;
  margin: 0.5rem 0;
}

.location {
  font-size: 0.9rem;
  color: #888;
  margin: 0.5rem 0;
}

.date {
  font-size: 0.9rem;
  color: #aaa;
  margin: 0.5rem 0;
}

.button-group {
  margin-top: 1rem;
  display: flex;
  justify-content: space-between;
}

.btn {
  padding: 0.5rem 1rem;
  font-size: 0.9rem;
  font-weight: 500;
  border: none;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.apply-btn {
  background-color: #28a745;
  color: #fff;
}

.apply-btn:hover {
  background-color: #218838;
}

.favorite-btn {
  background-color: #dc3545;
  color: #fff;
}

.favorite-btn:hover {
  background-color: #c82333;
}
</style>