<template>
  <div>
    <header class="header">
      <Nav />
    </header>
    <main>
      <section class="content">
        <!-- Acceso directo a los datos del usuario -->
        <h3 class="big-text">{{ auth.user.first_name }} {{ auth.user.last_name }}</h3><br>
        <p>Contenido simple para la página de prueba.</p>
      </section>
    </main>
  </div>
</template>

<script>
import Nav from '/resources/js/Pages/Nav.vue'; // Asegúrate de que la ruta sea correcta

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
