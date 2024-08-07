<template>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <!-- <div class="vacancy-card">

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
  </div> -->

  <div class="vacancy-card">
    <div class="item1">
      <div>
        <div class="custom-size mx-auto relative overflow-hidden">
          <img class="w-full h-full object-cover rounded-full" :src="imageSrc" alt="" />
          <div
            class="absolute w-full h-full rounded-full bg-black opacity-0 hover:opacity-75 transition-opacity duration-300"
          ></div>
          <div
            class="absolute bottom-0 right-0 w-10 h-10 rounded-full bg-black opacity-0 hover:opacity-75 transition-opacity duration-300"
          >
            <div
              class="absolute inline-flex items-center justify-center w-full h-full rounded-full bg-gray-900 opacity-0 hover:opacity-75 transition-opacity duration-300"
            ></div>
          </div>
        </div>
      </div>

<div class="flex items-center justify-center">
 <button
  @click="toggleFavorite"
  :class="[
    'flex items-center px-4 py-2 border font-semibold rounded-lg shadow-sm h-10',
    isFavorite ? 'border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white' : 'border-gray-700 text-gray-700 hover:bg-gray-700 hover:text-gray-100'
  ]"
>
  <i class="fas fa-bookmark mr-2"></i>
  {{ isFavorite ? 'Guardado' : 'Guardar' }}
</button>

</div>


    </div>
    <div class="item2">
    <div class="vacancy-creadted">
    <h1>{{ companyName }}</h1> <h5 class="text-gray-500">{{ formattedDate }}</h5>
    </div>
    <div class="vacancy-description">

         <a :href="'/vacante/' + id">
    <h1>{{ vacancyName }}</h1>
</a>
    <div class="extra">
    
        <span>{{ area_id }}</span>
        <span>{{ position_id }}</span>
    </div>
    </div>
    </div>
    <div class="item3">
    
    <div class="sueldo">
    <h1 class="salario">{{ formattedSalary }}</h1>
    <h3 class="provincia"> {{ province_id }}</h3>
    </div>
 <div>
 <button 
      :class="isApplied ? 'bg-blue-700 text-white' : 'bg-gray-900 text-white  hover:bg-blue-700'" 
      @click="applyForVacancy" 
      :disabled="isApplied"
    >
      {{ isApplied ? 'Aplicado' : 'Aplicar' }}
    </button> </div>
   
    </div>
  </div>
</template>

<script setup>
import { defineProps, computed, ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";


// Props del componente
const props = defineProps({
  id: Number,
  vacancyName: String,
  companyName: String,
  createdAt: String,
  imageSrc: {
    type: String,
    default: "/images/favicon.ico",
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
const isFavorite = ref(false);
const isApplied = ref(false);
const favoriteIds = ref([]);
const appliedIds = ref([]);
// Verifica el estado de autenticación y obtiene los datos del usuario al montar el componente
const checkAuthentication = async () => {
  try {
    const response = await axios.get("/auth/status");
    isAuthenticated.value = response.data.authenticated;

    if (isAuthenticated.value) {
      // Obtener datos del usuario si está autenticado
      const userResponse = await axios.get("/user");
      userId.value = userResponse.data.id;

      // Verificar si la vacante está en favoritos o ya aplicada
      checkFavoriteStatus();
      checkApplicationStatus();
    }
  } catch (error) {
    console.error("Error checking authentication status:", error);
  }
};

// Función para verificar si la vacante está en favoritos
const checkFavoriteStatus = async () => {
  try {
    // Obtén todos los favoritos
    const response = await axios.get('/favoritess');
    const favorites = response.data;
    console.log(favorites);

    // Actualiza la lista de IDs de favoritos
    favoriteIds.value = favorites.map(fav => fav.vacancy_id);

    // Verifica si el ID actual está en la lista de favoritos
    isFavorite.value = favoriteIds.value.includes(props.id);
  
  } catch (error) {
    console.error('Error checking favorite status:', error);
    isFavorite.value = false;
  }
};

// Función para verificar si la vacante ya está aplicada
const checkApplicationStatus = async () => {
  try {
    // Obtén todas las aplicaciones
    const response = await axios.get('/applicationss');
    const applications = response.data;

    // Actualiza la lista de IDs de aplicaciones
    appliedIds.value = applications.map(app => app.vacancy_id);

    // Verifica si el ID actual está en la lista de aplicaciones
    isApplied.value = appliedIds.value.includes(props.id);
    console.log('Application status:', isApplied.value);
  } catch (error) {
    console.error('Error checking application status:', error);
    isApplied.value = false;
  }
};

// Funciones para redirigir al usuario a la página de registro o inicio de sesión
const redirectToRegister = () => {
  window.location.href = "/register";
};

const redirectToLogin = () => {
  window.location.href = "/login";
};

// Función para aplicar a una vacante
const applyForVacancy = async () => {
  await checkAuthentication(); // Verifica la autenticación antes de proceder

  if (!isAuthenticated.value) {
    Swal.fire({
      title: "¡Necesitas estar registrado!",
      text: "Por favor, regístrate o inicia sesión para aplicar a una vacante.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Registrarse",
      cancelButtonText: "Iniciar sesión",
    }).then((result) => {
      if (result.isConfirmed) {
        redirectToRegister();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        redirectToLogin();
      }
    });
    return;
  }

  // Confirmación antes de enviar la aplicación
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¿Deseas aplicar a esta vacante?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Sí, aplicar',
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then(async (result) => {
    if (result.isConfirmed) {
      try {
        const response = await axios.post("/applications", {
          vacancy_id: props.id,
        });

        Swal.fire({
          title: "¡Éxito!",
          text: response.data.message || "¡Vacante aplicada exitosamente!",
          icon: "success",
          confirmButtonText: "OK",
          cancelButtonText: "Ir a Postulacion",
          showCancelButton: true,
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            console.log("¡Vacante aplicada exitosamente!");
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = "/applications";
          }
        });

        // Actualizar estado de aplicación
        isApplied.value = true;
      } catch (error) {
        Swal.fire({
          title: "¡Error!",
          text: error.response?.data.message || "Hubo un error al enviar tu aplicación.",
          icon: "error",
          confirmButtonText: "OK",
          cancelButtonText: "Ver postuladas",
          showCancelButton: true,
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          } else if (result.isDismissed) {
            window.location.href = "/applications";
          }
        });
      }
    }
  });
};

// Función para agregar a favoritos
const toggleFavorite = async () => {
  await checkAuthentication(); // Verifica la autenticación antes de proceder

  if (!isAuthenticated.value) {
    Swal.fire({
      title: "¡Necesitas estar registrado!",
      text: "Por favor, regístrate o inicia sesión para agregar a favoritos.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Registrarse",
      cancelButtonText: "Iniciar sesión",
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
    const response = await axios.post("/favorites", {
      user_id: userId.value, // Usa el ID del usuario
      vacancy_id: props.id,
    });

    Swal.fire({
      title: "¡Éxito!",
      text: response.data.message || "¡Vacante añadida a favoritos!",
      icon: "success",
      confirmButtonText: "OK",
    });

    // Actualizar estado de favoritos
    isFavorite.value = true;
  } catch (error) {
    Swal.fire({
      title: "¡Error!",
      text: error.response?.data.message || "Hubo un error al añadir la vacante a favoritos.",
      icon: "error",
      confirmButtonText: "OK",
    });
  }
};

// Formatear la fecha
const formattedDate = computed(() => {
  return new Date(props.createdAt).toLocaleDateString();
});

// Formatear el salario
const formattedSalary = computed(() => {
  return formatCurrency(props.salary);
});

// Función de formateo de moneda
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('es-DO', {
    style: 'currency',
    currency: 'DOP',
    minimumFractionDigits: 0, // No mostrar fracciones
    maximumFractionDigits: 0, // No mostrar fracciones
  }).format(amount);
};

// Llama a checkAuthentication al montar el componente
onMounted(async () => {
    checkFavoriteStatus();
     checkApplicationStatus() 
      // Ejecuta ambas funciones simultáneamente

});

</script>




<style scoped>
.custom-size {
  width: 4rem; /* Ajusta el ancho según sea necesario */
  height: 4rem; /* Ajusta la altura según sea necesario */
}

.vacancy-card {
  background-color: #ffffff;
  border-radius: 13px;
  border: #0000001f 1px solid;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 100%;
  height: 365px;

  display: grid;
  grid-template-rows: repeat(5, 1fr);
  grid-template-columns: 1fr;
  /* gap: 10px;  */
  padding: 5px;
}

.vacancy-description {
    font-size: 20px;
}


.item1 {
  grid-row: 1 / span 1; /* Ocupa 1 fila */
  /* background-color: lightblue; */
  padding: 10px;

  display: flex;
  justify-content: space-between;
  max-height: 1fr;

  
}
.vacancy-creadted {
  display: flex;
  gap: 10px;
  align-items: flex-start;

  margin-bottom: 10px;


  font-size: 17px;
  font-weight: bolder;
}

.vacancy-creadted h5{
  font-size: 15px;
  font-weight: normal;
}


/* item 2 --------------------------------------------------------------------- */


.item2 {
  grid-row: 2 / span 3; /* Ocupa 3 filas */
  /* background-color: lightcoral; */
  padding: 20px;
  height: auto;



}



.vacancy-description h1{
  font-size: 25px;
  font-weight: bold;
}

.vacancy-description  .extra {
  margin-top: 10px;
  display: flex;
  gap: 10px;
}
.vacancy-description span{
  font-size: 14px;
  font-weight: bold;
  background-color: #e6e6e6;


  border-radius: 10px;
  padding: 7px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: lighter;
}
/* // item 3 --------------------------------------------------------------------- */

.item3 {
  grid-row: 5 / span 1; /* Ocupa 1 fila */
  /* background-color: lightgreen; */
  padding: 25px;
  border-top: solid 1.7px rgba(22, 22, 22, 0.123);


  
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 20px;
  max-height: 80px;
  overflow: hidden; 
}



.item3 .salario{
  font-size: 20px;
  font-weight: bold;
}

.item3 .provincia{
  font-size: 16px;
  font-weight:500;
}
.item3 button {
  /* Fondo negro */
  color: white; /* Texto blanco */
  border: none; /* Sin borde */
  border-radius: 12px; /* Bordes redondeados */
  padding: 10px 20px; /* Espaciado interno */
  font-size: 16px; /* Tamaño de fuente */
  cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
  transition: all 0.3s ease; /* Transición suave para hover y active */
}

.item3 button:hover {
  background-color: #333; /* Fondo negro más claro en hover */
  transform: scale(1.05); /* Aumenta ligeramente el tamaño en hover */
}

.item3 button:active {
  background-color: #555; /* Fondo negro aún más claro al hacer clic */
  transform: scale(0.95); /* Reduce ligeramente el tamaño al hacer clic */
}




</style>
