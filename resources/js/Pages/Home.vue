<template>
  <div class="/">
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
          <li><a href="#">Encuentra Pasantías</a></li>
          <li><a href="#">Soporte Técnico</a></li>
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
            <div class="search-bar">
              <div class="search-input">
                <input type="text" placeholder="Localización" />
              </div>
              <div class="search-input">
                <input type="text" placeholder="Puesto" />
              </div>
              <button>
                <span class="search-icon">🔍</span> Buscar
              </button>
            </div>
          </div>
        </div>
      </section>
<<<<<<< HEAD
=======
      <div class="flex flex-col min-h-screen">
        
  <!-- Contenido principal aquí -->
  <div class="flex-grow">
    <!-- ... -->
  </div>
  
  <!-- Footer ajustado sin posición absoluta -->
  <footer class="bg-orange-500 text-white py-2 text-xs">
    <div class="container mx-auto flex flex-wrap justify-between">
      <!-- Contenido del footer -->
      <div class="w-full sm:w-1/3 px-4 mb-4 sm:mb-0 p-2">
        <div class="flex items-center mb-2">
          <h1 class="text-xl font-bold">Pasangüino</h1>
        </div>
        
        <p>Mejoramos y facilitamos cada día la búsqueda y aplicación a pasantías en toda la República Dominicana.</p>
      </div>
      <div class="w-full sm:w-1/6 px-4 mb-4 sm:mb-0">
        <h2 class="text-lg font-semibold mb-2">Información</h2>
        <ul>
          <li class="mb-1"><a href="/about-us" class="hover:underline">Sobre nosotros</a></li>
          <li class="mb-1"><a href="/contact-us" class="hover:underline">Contáctanos</a></li>
        </ul>
      </div>
      <div class="w-full sm:w-1/6 px-4">
        <h2 class="text-lg font-semibold mb-2">Más</h2>
        <ul>
          <li class="mb-1"><a href="/privacy" class="hover:underline">Privacidad</a></li>
          <li class="mb-1"><a href="/terms" class="hover:underline">Términos y condiciones</a></li>
          <li class="mb-1"><a href="/help" class="hover:underline">Ayuda</a></li>
          <li class="mb-1"><a href="/faq" class="hover:underline">FAQ</a></li>
        </ul>
      </div>
    </div>
    <hr class="border-t border-white/50 my-2">
    <div class="text-center mt-2 text-white/70">
      &copy; 2024 Pasangüino. Todos los derechos reservados.
    </div>
  </footer>
</div>
>>>>>>> origin/Adrian
    </main>
  </div>
</template>

<script>
import HomeScript from '/resources/js/Home.js';

export default {
  name: 'Home',
  mounted() {
    HomeScript.mounted.call(this); // Llama al método mounted de Home.js y pasa el contexto de Vue
  }
};
</script>

<style scoped src="/resources/css/Home.css"></style>
