<template>
  <div class="two-column-layout">
    <div class="left-column">
      <h1><b>Somos Pasangüino.</b></h1>
      <p v-html="leftColumnText"></p>
    </div>
    <div class="right-column">
      <img src="/images/ft_1.jpg" class="image">
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      leftColumnText: `<strong> <p class="text-lg ">Somos una plataforma dedicada a mejorar y facilitar la búsqueda y aplicación a pasantías en toda la República Dominicana.</strong><br>
                       Nuestro objetivo es conectar a estudiantes y profesionales con oportunidades de pasantías en empresas de diversos sectores, brindando una experiencia sencilla y efectiva. Estamos encargados de que la búsqueda de pasantias no sea tan complicada para los estudiantes. Con esta página podemos conectar con las empresas que solicitan nuestro talento como pasantes en el área de nuestra elección. De esta manera aumentamos la facilidad de que las empresas tengan buenos postulantes a las bancarias necesarias y facilitará al estudiante tener más oportunidades laborales, <br>
                       <b>Pasanguino</b>es una plataforma intuitiva con distintas formas de tener acceso a las vacantes disponibles. <b>La búsqueda de Pasantia no es tan mala con Pasanguino.</b></p>
                       <p class="text-lg mt-4">Para más información, no dudes <a href="#" class="text-blue-300 hover:underline">contactarnos</a>.</p>`

                       
     }
  }
}
</script>


<style scoped>
.two-column-layout {
  display: flex;
  height: 100vh;
}

.left-column, .right-column {
  flex: 1;
  padding: 0px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.left-column {
  padding: 30px;
  background-color: #ca760fdb;
}


.image {
  max-width: 100%;
  max-height: 128%;
  margin-bottom: 200px;
}

h1 {
  font-size: 2.5em;
  margin-bottom: 20px;
}
</style>







