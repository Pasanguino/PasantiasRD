<template>
  <div class="profile-container">
    <div class="sidebar" :class="{ 'slide-in': slideIn }">
      <div class="profile-info">
        <img :src="userLogoUrl" alt="Profile Image" class="profile-image">
      </div>
      <div class="sidebar-header">
        <img src="/images/logo.png" alt="Logo" class="sidebar-logo">
        <span class="sidebar-title">Pasangüino</span>
      </div>
      <ul class="menu">
        <li>
          <div class="logo-upload">
            <label for="logo">Cambiar Logo:</label>
            <div id="logo" @drop.prevent="onFileDrop" @dragover.prevent @click="triggerFileInput">
              <input type="file" ref="fileInput" @change="onFileChange" style="display: none;">
              <p>Arrastra una imagen aquí o haz clic para seleccionar un archivo</p>
            </div>
          </div>
        </li>
        <li><a href="company-profile">Editar perfil</a></li>
        <li><a href="company-settings">Configuración</a></li>
        <li><a href="#">Cerrar sesión</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="header-background">
        <div class="header">
          <h1>CLARO</h1>
        </div>
      </div>
      <hr>
      <div class="settings">
        <div class="about-us">
          <label for="about">Acerca de Nosotros</label>
          <textarea id="about" rows="3" v-model="aboutUs"></textarea>
        </div>
        <div class="location">
          <label for="location">Localización</label>
          <textarea id="location" rows="2" v-model="location"></textarea>
        </div>
        <div class="contact-info">
          <h2>Información de Contacto:</h2>
          <label for="email">Dirección de correo electrónico:</label>
          <input type="email" id="email" v-model="email">
          <label for="phone">Número de teléfono:</label>
          <input type="text" id="phone" v-model="phone">
        </div>
      </div>
      <div class="save-button">
        <button @click="saveChanges" class="btn btn-outline">Guardar cambios</button>
      </div>
    </div>

    <!-- Botón para desplazarse al inicio -->
    <div v-if="showReturnText" class="return-text">
      <button @click="scrollToTop">Volver al inicio</button>
    </div>

    <!-- Botón para volver a la página principal -->
    <div class="return-home">
      <a href="/home">Volver al Inicio</a>
    </div>

    <!-- Mensajes de éxito -->
    <div v-if="showSuccessMessage" class="success-message">
      <p>{{ successMessage }}</p>
    </div>
  </div>
</template>

<script>
import CompanyProfileScript from '/resources/js/CompanyProfile.js';

export default {
  name: 'CompanyProfile',
  mounted() {
    CompanyProfileScript.mounted.call(this);
  },
  data() {
    return CompanyProfileScript.data.call(this);
  },
  methods: CompanyProfileScript.methods
};
</script>

<style scoped src="/resources/css/CompanyProfile.css"></style>
