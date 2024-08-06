<template>
  <div>
    <header class="header">
      <Nav />
    </header>
    <main>
      <section class="content">
        <h1>Esta es una página de prueba</h1>
        <p>Contenido simple para la página de prueba.</p>
      </section>
    </main>
  </div>
</template>

<script>
import Nav from '/resources/js/Pages/Nav_student.vue'; // Asegúrate de que la ruta sea correcta

export default {
  name: 'Test',
  components: {
    Nav
  }
};
</script>

<style scoped>
.header {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.content {
  text-align: center;
  margin-top: 20px;
}
</style>
