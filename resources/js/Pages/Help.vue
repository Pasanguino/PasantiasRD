<template>
  <div>
    <Nav />
    <div class="help-container">
      <h1>Cómo Podemos Ayudarte</h1>
      <section>
        <h2>Asistencia General</h2>
        <p>
          Si tienes alguna pregunta sobre el proceso de búsqueda de pasantías o necesitas ayuda para completar tu perfil, estamos aquí para ayudarte.
        </p>
        <p>
          Consulta nuestras <a href="/faq">Preguntas Frecuentes</a> para obtener respuestas rápidas a las preguntas comunes.
        </p>
      </section>
      <section>
        <h2>Contacta con Nuestro Soporte</h2>
        <p>
          Si no encuentras la respuesta que necesitas, puedes ponerte en contacto con nuestro equipo de soporte enviando un correo a 
          <a href="mailto:support@pasantiasrd.test">support@pasantiasrd.test</a>.
        </p>
        <p>
          También puedes usar nuestro <a href="/contact">formulario de contacto</a> para enviar una consulta directa.
        </p>
      </section>
      <section>
        <h2>Guías y Recursos</h2>
        <p>
          Accede a nuestras guías y recursos para mejorar tu búsqueda de pasantías y optimizar tu perfil:
        </p>
        <ul>
          <li><a href="/guide/profile-tips">Consejos para Optimizar tu Perfil</a></li>
          <li><a href="/guide/application-tips">Consejos para la Aplicación a Pasantías</a></li>
          <li><a href="/guide/interview-tips">Consejos para Entrevistas</a></li>
        </ul>
      </section>
    </div>
    <Footer />
  </div>
</template>

<script>
import Nav from './Nav.vue';
import Footer from '@/Components/Footer.vue';

export default {
  name: 'Help',
  components: {
    Nav,
    Footer
  }
}
</script>

<style scoped>
.help-container {
  padding: 20px;
  max-width: 800px;
  margin: auto;
  color: #333;
  font-family: 'Arial', sans-serif;
}

h1 {
  color: #004d99; /* Azul oscuro */
  font-size: 28px;
  margin-bottom: 20px;
}

h2 {
  color: #0066cc; /* Azul más claro */
  font-size: 22px;
  margin-top: 20px;
  margin-bottom: 10px;
}

p {
  margin-bottom: 15px;
  line-height: 1.6;
}

a {
  color: #0056b3; /* Azul más intenso */
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

ul {
  list-style-type: disc;
  margin: 0;
  padding: 0 0 0 20px;
}

li {
  margin-bottom: 10px;
}
</style>
