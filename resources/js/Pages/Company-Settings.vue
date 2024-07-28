<template>
  <div class="profile-container" :class="{ 'dark-mode': isDarkMode }">
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
        <h3 class="big-text">Configuración</h3><br>
        <a href="#" @click="showChangeUsernameModal = true" class="inter-font">Cambiar nombre de usuario</a><br><br>
        <a href="#" @click="showChangePasswordModal = true" class="inter-font">Cambiar contraseña</a><br><br>
        <p>Correo de recuperación actual: <span class="inter-font">johndoe@test.com</span></p><br>
        <a href="#" @click="showAddRecoveryEmailModal = true" class="inter-font">Añadir correo de recuperación</a><br><br>
        <a href="#" @click="showChangeRecoveryEmailModal = true">Cambiar correo de recuperación</a>
      </div>
      <div class="theme-switcher">
        <label for="theme-toggle" class="lilita-font">Cambiar tema</label>
        <label class="switch">
          <input type="checkbox" id="theme-toggle" v-model="isDarkMode" @change="toggleTheme">
          <span class="slider round"></span>
        </label>
        <label for="theme-toggle" class="lilita-font">Claro/Oscuro</label>
      </div>
      <div class="account-actions">
        <a href="#" @click="showDeactivateModal = true">Desactivar/eliminar cuenta</a>
      </div>
    </div>

    <!-- Botón para desplazarse al inicio -->
    <div v-if="showReturnText" class="return-text">
      <button @click="scrollToTop">Volver al inicio</button>
    </div>
    
    <!-- Botón para volver a la página principal -->
    <div class="return-home">
      <a href="/home">Volver al Inicio</a></div>

    <!-- Modals -->
    <div v-if="showDeactivateModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showDeactivateModal = false">&times;</span>
        <h2>¿Quieres desactivar tu cuenta o eliminarla?</h2>
        <p>Si la desactivas podrás volverla a activarla más tarde, si la eliminas esta opción no tiene marcha atrás todo se habrá eliminado y no podrá recuperarlo.</p>
        <button @click="confirmDeleteAccount" class="btn btn-primary">Eliminar mi cuenta</button>
        <button @click="deactivateAccount" class="btn btn-secondary">Desactivar mi cuenta</button>
      </div>
    </div>

    <div v-if="showConfirmDeleteModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showConfirmDeleteModal = false">&times;</span>
        <h2>Confirmar eliminación de cuenta</h2>
        <p>¿Estás seguro de que deseas eliminar tu cuenta? Se enviará un correo para confirmar la eliminación.</p>
        <button @click="sendDeleteConfirmation" class="btn btn-primary">Sí, eliminar</button>
        <button @click="showConfirmDeleteModal = false" class="btn btn-secondary">Cancelar</button>
      </div>
    </div>

    <div v-if="showChangeUsernameModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showChangeUsernameModal = false">&times;</span>
        <h2>Cambiar nombre de usuario</h2>
        <div class="form-group">
          <label for="new-username">Nuevo nombre de usuario</label>
          <input type="text" id="new-username" v-model="newUsername" class="form-input">
        </div>
        <button @click="changeUsername" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>

    <div v-if="showChangePasswordModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showChangePasswordModal = false">&times;</span>
        <h2>Cambiar contraseña</h2>
        <div class="form-group">
          <label for="current-password">Contraseña actual</label>
          <input type="password" id="current-password" v-model="currentPassword" class="form-input">
        </div>
        <div class="form-group">
          <label for="new-password">Nueva contraseña</label>
          <input type="password" id="new-password" v-model="newPassword" class="form-input">
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirmar nueva contraseña</label>
          <input type="password" id="confirm-password" v-model="confirmPassword" class="form-input">
        </div>
        <button @click="changePassword" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>

    <div v-if="showAddRecoveryEmailModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showAddRecoveryEmailModal = false">&times;</span>
        <h2>Añadir correo de recuperación</h2>
        <div class="form-group">
          <label for="new-recovery-email">Nuevo correo de recuperación</label>
          <input type="email" id="new-recovery-email" v-model="newRecoveryEmail" class="form-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <button @click="addRecoveryEmail" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>

    <div v-if="showChangeRecoveryEmailModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showChangeRecoveryEmailModal = false">&times;</span>
        <h2>Cambiar correo de recuperación</h2>
        <div class="form-group">
          <label for="current-recovery-email">Correo de recuperación actual</label>
          <input type="email" id="current-recovery-email" v-model="currentRecoveryEmail" class="form-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <div class="form-group">
          <label for="new-recovery-email">Nuevo correo de recuperación</label>
          <input type="email" id="new-recovery-email" v-model="newRecoveryEmail" class="form-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <button @click="changeRecoveryEmail" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>

    <!-- Mensajes de éxito -->
    <div v-if="showSuccessMessage" class="success-message">
      <p>{{ successMessage }}</p>
    </div>
  </div>
</template>

<script>
import CompanySettingsScript from '/resources/js/CompanySettings.js';

export default {
  name: 'CompanySettings',
  mounted() {
    CompanySettingsScript.mounted.call(this);
  },
  data() {
    return CompanySettingsScript.data.call(this);
  },
  methods: CompanySettingsScript.methods
};
</script>

<style scoped src="/resources/css/CompanySettings.css"></style>
