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
import Nav from '/resources/js/Pages/Nav_student.vue';
import SettingsScript from '/resources/js/Settings.js';

export default {
  name: 'Test',
  props: {
    auth: Object, // Recibe `auth` que contiene `user`
  },
  data() {
    return SettingsScript.data();
  },
  mounted() {
    SettingsScript.mounted.call(this);
  },
  methods: SettingsScript.methods
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
  