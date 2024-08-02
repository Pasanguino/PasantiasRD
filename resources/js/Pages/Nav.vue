<template>
  <div class="nav-wrapper">
    <div class="nav-logo">
      <img src="/images/logo.png" alt="Logo" class="logo-image" />
      <span class="logo-title">Pasangüino</span>
    </div>
    <nav class="nav-container">
      <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/estudiante">Encuentra Pasantías</a></li>

        <li><a href="#">Bandeja de Mensajes</a></li>
        <li><a href="/help">Soporte Técnico</a></li>
      </ul>
    </nav>
    <div class="user-dropdown">
      <i class="material-icons user-icon" style="font-size: 45px; color: black"
        >&#xe853;</i
      >
      <div class="dropdown-content">
        <a :href="route('profile')" as="a">Editar perfil</a>
        <a :href="route('settings')" as="a">Configuración</a>
        <a href="#" @click.prevent="logout" class="dropdown-item">Cerrar sesión</a>
      </div>
    </div>
  </div>
  <hr class="nav-divider" />
</template>

<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import { ref } from "vue";

const logout = () => {
  const form = document.createElement("form");
  form.method = "POST";
  form.action = route("logout");

  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
  const input = document.createElement("input");
  input.type = "hidden";
  input.name = "_token";
  input.value = csrfToken;
  form.appendChild(input);

  document.body.appendChild(form);
  form.submit();
};
</script>

<style scoped>
.nav-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 0 20px;
  animation: fadeIn 1s ease-out; /* Aplica la animación al contenedor */
}

.nav-wrapper::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("/images/building1.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  transform: scaleX(-1); /* Invierte solo la imagen de fondo */
  z-index: -1;
}

.nav-logo {
  display: flex;
  align-items: center;
}

.logo-image {
  width: 150px;
  height: auto;
}

.logo-title {
  margin-left: 10px;
  font-size: 24px;
  font-weight: bold;
  color: white;
  text-shadow: 1px 1px 2px black, -1px -1px 2px black;
}

.nav-container {
  flex: 1;
  display: flex;
  justify-content: center;
  margin-left: -150px;
}

.nav-links {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding: 18px 20px;
  background-color: #bf5f07;
  border-radius: 50px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 25px 0;
  opacity: 0;
  animation: slideIn 1s ease-out forwards; /* Aplica la animación */
}

.nav-links li {
  margin: 5px 10px;
}

.nav-links li a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

.user-dropdown {
  position: relative;
  display: flex;
  align-items: center;
}

.user-icon {
  cursor: pointer;
  color: black;
}

.dropdown-content {
  display: none;
  position: absolute;
  top: 45px;
  right: 0;
  background-color: white;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  padding: 12px 16px;
  z-index: 3;
}

.user-dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
  padding: 8px 0;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.nav-divider {
  border: none;
  border-top: 4px solid #bf5f07;
  margin: 0;
  width: 100%;
  position: relative;
  top: -4px;
  border-radius: 4px;
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
  opacity: 0;
  animation: fadeIn 0.5s ease-out forwards;
}
</style>
