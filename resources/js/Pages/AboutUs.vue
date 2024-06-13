<template>
    <div class="about-us">
      <h1 class="text-3xl font-bold mb-4 text-blue-500">Sobre Nosotros</h1>
      <p class="text-lg text-white">Somos Pasangüino, una plataforma dedicada a mejorar y facilitar la búsqueda y aplicación a pasantías en toda la República Dominicana.</p>
      <p class="text-lg text-white mt-4">Nuestro objetivo es conectar a estudiantes y profesionales con oportunidades de pasantías en empresas de diversos sectores, brindando una experiencia sencilla y efectiva.</p>
      <p class="text-lg text-white mt-4">Para más información, no dudes en <a href="#" class="text-blue-500 hover:underline">contactarnos</a>.</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AboutUs'
  }
  </script>
  
  <style scoped>
  .about-us {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: #007BFF;
  }
  
  .about-us h1 {
    color: #007BFF; 
  }
  
  .about-us p {
    color: #fff;
  }
  </style>
  