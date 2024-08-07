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

<Destacadas />


   <div class="container_preparation">
        <h1 class="title">Guía de Preparación para Entrevistas</h1>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/ZqqEPWe1Ad0" title="Guía de Preparación para Entrevistas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
 
     <section class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800"> Logros</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Imagen 1 -->
            <div class="gallery-item col-span-2 row-span-2 overflow-hidden rounded-lg">
                <img src="https://eldinero.com.do/wp-content/uploads/dplnews_claro-dominicana_mc261121.jpeg" alt="Imagen 1" class="w-full h-full object-cover">
            </div>
            <!-- Imagen 2 -->
            <div class="gallery-item overflow-hidden rounded-lg">
                <img src="https://eldinero.com.do/wp-content/uploads/Fachada-banco-BHD-Leon.jpg" alt="Imagen 2" class="w-full h-full object-cover">
            </div>
            <!-- Imagen 3 -->
            <div class="gallery-item overflow-hidden rounded-lg">
                <img src="https://eldinero.com.do/wp-content/uploads/Trabajo-2-e1588360153270.jpg" alt="Imagen 3" class="w-full h-full object-cover">
            </div>
            <!-- Imagen 4 -->
            <div class="gallery-item col-span-2 overflow-hidden rounded-lg">
                <img src="https://i.pinimg.com/originals/de/89/04/de89041da6bf2aaa8ba8f92dc5cfce63.jpg" alt="Imagen 4" class="w-full h-full object-cover">
            </div>
            <!-- Imagen 5 -->
            <div class="gallery-item overflow-hidden rounded-lg">
                <img src="https://cloudfront-us-east-1.images.arcpublishing.com/bloomberglinea/BVGSZKTCCNC63EEM32MXUZ6W5E.jpg" alt="Imagen 5" class="w-full h-full object-cover">
            </div>
        </div>
    </section>


<!-- component -->
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center m-20">
  <div class="container max-w-screen-lg mx-auto">
    <div>
      <h2 class="font-semibold text-xl text-gray-600">Formulario Responsive</h2>
      <p class="text-gray-500 mb-6">El formulario es responsive para móviles. ¡Pruébalo!</p>

      <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <p class="font-medium text-lg">Datos Personales</p>
            <p>Por favor, completa todos los campos.</p>
          </div>

          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="full_name">Nombre Completo</label>
                <input type="text" name="full_name" id="full_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div>

              <div class="md:col-span-5">
                <label for="email">Correo Electrónico</label>
                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="email@dominio.com" />
              </div>

              <div class="md:col-span-3">
                <label for="address">Dirección / Calle</label>
                <input type="text" name="address" id="address" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-2">
                <label for="city">Ciudad</label>
                <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-2">
                <label for="country">País / Región</label>
                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <input name="country" id="country" placeholder="País" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                  <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                  </button>
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                  </button>
                </div>
              </div>

              <div class="md:col-span-2">
                <label for="state">Estado / Provincia</label>
                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <input name="state" id="state" placeholder="Estado" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                  <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                  </button>
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                  </button>
                </div>
              </div>

              <div class="md:col-span-1">
                <label for="zipcode">Código Postal</label>
                <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
              </div>

              <div class="md:col-span-5">
                <div class="inline-flex items-center">
                  <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                  <label for="billing_same" class="ml-2">Mi dirección de facturación es diferente a la anterior.</label>
                </div>
              </div>

              <div class="md:col-span-2">
                <label for="soda">¿Cuántos refrescos?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <input name="soda" id="soda" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <a href="https://www.buymeacoffee.com/dgauderman" target="_blank" class="md:absolute bottom-0 right-0 p-4 float-right">
      <img src="https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-2.svg" alt="Buy Me A Coffee" class="w-12">
    </a>
  </div>
</div>


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
