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
  <img src="/images/background_home.png" alt="Background" class="background_image hidden sm:block" />
</div>

        <nav class="nav-container">
          <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/estudiante">Encuentra Pasantías</a></li>
            <li><a href="/support">Soporte Técnico</a></li>
          </ul>
        </nav>
        <div class="auth-links hidden sm:block">
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

          <div class="flex items-center space-x-4 p-4 border rounded-lg bg-blue-500 shadow-md">
  <div class="flex-grow">
    <input 
      type="text" 
      placeholder="Localización" 
      class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>
  <div class="flex-grow">
    <input 
      v-model="searchQuery" 
      type="search" 
      id="default-search" 
      placeholder="Puesto" 
      class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>
<button 
  type="submit" 
  class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
>
  <span class="text-lg">🔍</span> Buscar
</button>

</div>

                </form>
            </div>
          </div>
        </section>




  

        <!-- Contenido principal aquí -->

      </main>
    </div>

   

        <!-- Incluyendo el componente de carrusel -->
        <section id="encuentra-pasantias" class="carousel-section">
          <FindInternships />
        </section>

               <section class="mt-20">
         <div class="text-center p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">¡Encuentra tu camino al éxito!</h1>
        <p class="text-lg text-gray-700">Conéctate con las mejores oportunidades de pasantías en República Dominicana y comienza tu carrera profesional.</p>
    </div>
        </section>


<Count />

<section>
<Categorias />
</section>


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
import Categorias from '@/Components/Specific/Categorias.vue';
import Count from '@/Components/Specific/Count.vue';
import Destacadas from '@/Components/Specific/Destacadas.vue';
import ContactUs from './FAQ.vue';

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
