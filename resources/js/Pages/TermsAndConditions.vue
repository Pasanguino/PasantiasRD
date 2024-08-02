<template>
    <Nav></Nav>
  <div class="policy-container">
    <h1>Esta política de condiciones de uso es válida a partir del Aug 2024</h1>
    <section>
      <h2>TÉRMINOS Y CONDICIONES</h2>
      <p>
        d, persona jurídica de derecho privado describe, a través de este documento, las normas de uso del sitio 
        <a href="/" target="_blank">http://pasantiasrd.test/terms</a> y de cualquier otro sitio web, tienda o aplicación operada por el titular.
      </p>
      <p>
        Al navegar por este sitio web, consideramos que está de acuerdo con las condiciones de uso que figuran a continuación.
      </p>
      <p>
        Si no está de acuerdo con los términos de este acuerdo, le pedimos que no haga ningún otro uso de este sitio web, mucho menos que se registre o envíe sus datos personales.
      </p>
      <p>
        Si cambiamos nuestras condiciones de uso, publicaremos el nuevo texto en este sitio web, con una fecha de revisión actualizada. Podemos modificar este documento en cualquier momento.
      </p>
      <p>
        Si hay un cambio significativo en los términos de este acuerdo, podemos informarle utilizando la información de contacto que tenemos en nuestra base de datos o mediante una notificación.
      </p>
      <p>
        El uso de este sitio web después de los cambios significa que usted acepta las condiciones de uso revisadas. Si, después de leer la versión revisada, no está de acuerdo con sus términos, por favor, termine su acceso.
      </p>
    </section>
    <section>
      <h2>Sección 1 - Usuario</h2>
      <p>
        El uso de este sitio web le otorga automáticamente la condición de Usuario e implica su plena aceptación de todas las directrices y condiciones incluidas en estas Condiciones.
      </p>
    </section>
    <!-- Agrega aquí las demás secciones de la política -->
  </div>

  <Footer></Footer>
</template>

<script>
import Nav from './Nav.vue';
import Footer from '@/Components/Footer.vue';

export default {
  name: 'Policy',
  components: {
    Nav,
    Footer
  }
}
</script>

<style scoped>
.policy-container {
  padding: 20px;
  max-width: 800px;
  margin: auto;
  color: #333;
  font-family: Arial, sans-serif;
}

h1 {
  color: #FFA500; /* Color naranja */
  font-size: 24px;
  margin-bottom: 20px;
}

h2 {
  color: #FF8C00; /* Naranja más oscuro */
  font-size: 20px;
  margin-top: 20px;
  margin-bottom: 10px;
}

p {
  margin-bottom: 15px;
}

a {
  color: #FF4500; /* Naranja más intenso */
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>
