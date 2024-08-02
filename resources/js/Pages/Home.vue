<template>
  <Head title="Home" />

  <div class="todo">
    <div class="container-up">
      <header class="header">
        <div class="logo">
          <img src="/images/logo.png" alt="Logo" />
          <span>Pasangüino</span>
        </div>
        <div class="background-container">
          <img src="/images/background_home.png" alt="Background" class="background_image" />
        </div>
        <nav class="nav-container">
          <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/estudiante">Encuentra Pasantías</a></li>
            <li><a href="/support">Soporte Técnico</a></li>
          </ul>
        </nav>
        <div class="auth-links">
          <a href="login" class="login">Inicia sesión</a>
          <a href="register" class="register">Regístrate</a>
        </div>
      </header>
      <main>
        <section class="intro">
          <div class="intro-content">
            <h1><b>La Mejor Forma de Aplicar</b></h1>
            <h2><b><span>Rápidamente</span> a Pasantías</b></h2>
            <p>Cada mes tienes la oportunidad de<br>encontrar nuevas vacantes en tu área<br>de estudio.</p>
            <div class="search-bar-container">
            <form @submit.prevent="handleSearch">

              <div class="search-bar">
                <div class="search-input">
                  <input  type="text" placeholder="Localización" />
                </div>
                <div class="search-input">
                  <input v-model="searchQuery" type="search" id="default-search" ffff  placeholder="Puesto" />
                </div>
                <button  type="submit">
                  <span class="search-icon">🔍</span> Buscar
                </button>
              </div>
                </form>
            </div>
          </div>
        </section>

        <!-- Incluyendo el componente de carrusel -->
        <section id="encuentra-pasantias" class="carousel-section">
          <FindInternships />
        </section>

        <!-- Contenido principal aquí -->

      </main>
    </div>

    <Vacantes />

    <!-- Footer ajustado sin posición absoluta -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HomeScript from '/resources/js/Home.js';
import { Head, Link, useForm , router } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import Vacantes from '@/Components/Vacantes_provincias.vue';
import FindInternships from '@/Components/FindInternships.vue';

onMounted(() => {
  HomeScript.mounted.call(this);
});

const searchQuery = ref('');

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    router.get('/vacante/search/buscar', { buscar: searchQuery.value });
  }
  
  console.log("Search query submitted:", searchQuery.value);
};
</script>

<style scoped src="/resources/css/Home.css"></style>
