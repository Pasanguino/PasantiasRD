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
    </main>
  </div>
</template>

<script>
import HomeScript from '/resources/js/Home.js';

export default {
  name: 'Home',
  mounted() {
    HomeScript.mounted.call(this);
  }
};
</script>

<style scoped src="/resources/css/Home.css"></style>
