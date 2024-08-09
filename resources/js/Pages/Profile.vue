<template>
  <form @submit="submitForm" method="POST" enctype="multipart/form-data">

    <div class="profile-container">
      <div class="sidebar" :class="{ 'slide-in': slideIn }">
        <div class="profile-info">
          <img :src="userLogoUrl" alt="Profile Image" class="profile-image">
          <div class="sidebar-header">
            <img src="/images/logo.png" alt="Logo" class="sidebar-logo">
            <span class="sidebar-title">Pasangüino</span>
          </div>
        </div>
        <ul class="menu">
          <li>
            <!-- Futuros Elementos del menu -->
          </li>
        </ul>
      </div>
      <div class="main-content">
        <div class="header">
          <h1>Configuración</h1>
          <div class="user-dropdown">
            <i class="material-icons user-icon" style="font-size: 45px;">&#xe853;</i>
            <div class="dropdown-content">
              <a href="profile">Editar perfil</a>
              <a href="settings">Configuración</a>
              <a href="#">Cerrar sesión</a>
            </div>
          </div>
        </div>
        <hr>
        <div class="settings">
          <div class="settings-header">
            <div class="photo_path">
              <label for="photo-input">Arrastra una foto para cambiar el logo:</label>
              <div id="photo-drop" @drop.prevent="onPhotoFileDrop" @dragover.prevent @click="triggerPhotoFileInput">
                <input type="file" id="photo-input" name="photo_path" accept="image/*">
                <p>Arrastra una imagen aquí o haz clic para seleccionar un archivo</p>
              </div>
            </div>
            <div class="save-button">
              <button type="submit" class="btn btn-outline">Guardar cambios</button>
            </div>
          </div>

          <div class="cv_path">
            <label for="cv-input">Arrastra tu CV aquí:</label>
            <div id="cv-drop" @drop.prevent="onCvFileDrop" @dragover.prevent @click="triggerCvFileInput">
<input type="file" id="cv-input" name="cv_path" accept=".pdf,.doc,.docx" @change="handleFileChange">

              <p>Arrastra tu CV aquí o haz clic para seleccionar un archivo</p>
            </div>
            <div v-if="cvFileName" class="file-preview">
              <p>Archivo seleccionado: {{ cvFileName }}</p>
            </div>
          </div>
          

          <div class="description">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="3">{{ aboutUs }}</textarea>
          </div>

          <div class="age-us">
            <label for="age">Edad</label>
            <input type="number" id="age" name="age" :value="number">
          </div>

          <div class="identification_path">
            <label for="identification_path">Cédula</label>
            <input type="number" id="identification_path" name="identification_path" :value="number">
          </div>

          <div class="contact-info">
            <div class="mt-2 mb-5">
              <label for="profession">Profesión</label>
              <select id="profession" name="profession_id" class="block w-full p-2 border border-gray-300 rounded-md">
                <option v-for="area in areas" :key="area.id" :value="area.id">
                  {{ area.area_name }} (Vacantes: {{ area.vacancies_count }})
                </option>
              </select>
            </div>

            <label for="phone">Número de teléfono:</label>
            <input type="text" id="phone" name="phone" :value="phone">
          </div>
        </div>
      </div>

      <!-- Botón para desplazarse hacia arriba -->
      <div v-if="showReturnText" class="return-text">
        <button @click="scrollToTop">Volver al inicio</button>
      </div>

      <!-- Botón para volver a la página de inicio -->
      <div class="return-home">
        <a href="/home">Volver al Inicio</a>
      </div>

      <!-- Mensajes de éxito -->
      <div v-if="showSuccessMessage" class="success-message">
        <p>{{ successMessage }}</p>
      </div>
    </div>
  </form>
</template>

<script>
import ProfileScript from '/resources/js/Profile.js';
import axios from 'axios';

export default {
  name: 'Profile',
  data() {
    return {
      selectedProfession: null,
      areas: [],
      cvFileName: '',
      userLogoUrl: '',
      aboutUs: '',
      number: '',
      phone: '',
      showReturnText: false,
      showSuccessMessage: false,
      successMessage: '',
      ...ProfileScript.data(), // Combina los datos con los de ProfileScript
    };
  },
  mounted() {
    this.fetchAreas(); // Llama al API para obtener las áreas al montar el componente
    ProfileScript.mounted.call(this); // Llama al mounted de ProfileScript
  },
  methods: {
    async fetchAreas() {
      try {
        const response = await axios.get('/Area'); // Realiza la solicitud al API
        this.areas = response.data; // Almacena los datos obtenidos
      } catch (error) {
        console.error('Error al obtener las áreas:', error);
      }
    },
    async submitForm(event) {
      event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

      const formData = new FormData(event.target); // Crear un FormData con los datos del formulario

      try {
        const response = await axios.post('/profile', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        // Mostrar la respuesta JSON en consola
        console.log('Respuesta JSON:', response.data);
        this.successMessage = 'Datos enviados correctamente';
        this.showSuccessMessage = true;
      } catch (error) {
        console.error('Error al enviar los datos del perfil:', error);
        this.successMessage = 'Hubo un error al enviar los datos';
        this.showSuccessMessage = true;
      }
    },
    ...ProfileScript.methods, // Combina los métodos con los de ProfileScript
  },
};
</script>


<style scoped src="/resources/css/Profile.css"></style>
