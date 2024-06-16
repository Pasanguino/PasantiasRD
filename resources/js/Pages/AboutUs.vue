<template>
  <!-- Contenedor principal con el color de fondo naranja aplicado -->
  <div class="min-h-screen bg-orange-500 text-white">
    <div class="about-us p-8">
      <h1 class="text-3xl font-bold mb-4 text-white">Sobre Nosotros</h1>
      <p class="text-lg">Somos Pasangüino, una plataforma dedicada a mejorar y facilitar la búsqueda y aplicación a pasantías en toda la República Dominicana.</p>
      <p class="text-lg mt-4">Nuestro objetivo es conectar a estudiantes y profesionales con oportunidades de pasantías en empresas de diversos sectores, brindando una experiencia sencilla y efectiva.</p>
      <p class="text-lg mt-4">Para más información, no dudes en <a href="#" class="text-blue-300 hover:underline">contactarnos</a>.</p>
    </div>
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
}
</style>

