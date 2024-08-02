<template>
  <div class="background">
    <Nav></Nav>
    <div class="navigation-panel">
      <button class="nav-button" @click="currentView = 'PublicarVacantes'">Publicar vacantes</button>
      <button class="nav-button" @click="currentView = ''">Vacantes añadidas</button>
      <button class="nav-button" @click="currentView = 'EliminarVacantes'">Vacantes eliminadas</button>
    </div>
    <div class="main-content">
      <div class="left-panel">
        <div class="vacante" @click="currentView = 'PublicarVacantes'">
          <div :class="{'circle': true, 'active': currentView === 'PublicarVacantes'}">Añadir vacantes</div>
        </div>
        <div class="vacante" @click="currentView = 'EditarVacantes'">
          <div :class="{'circle': true, 'active': currentView === 'EditarVacantes'}">Editar vacantes</div>
        </div>
        <div class="vacante" @click="currentView = 'EliminarVacantes'">
          <div :class="{'circle': true, 'active': currentView === 'EliminarVacantes'}">Eliminar vacantes</div>
        </div>
      </div>
      <div class="right-panel">
        <div v-if="currentView === 'PublicarVacantes'" class="form-container">
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="nombre-puesto">Nombre del puesto</label>
              <input type="text" id="nombre-puesto" v-model="form.nombrePuesto" placeholder="Programador/Diseñador...">
            </div>
            <div class="form-group">
              <label for="descripcion-puesto">Descripción del puesto</label>
              <textarea id="descripcion-puesto" v-model="form.descripcionPuesto" placeholder="Buscamos pasante..."></textarea>
            </div>
            <div class="form-group">
              <label for="area">Área</label>
              <input type="text" id="area" v-model="form.area" placeholder="Robótica... Inteligencia artificial ... Desarrollo web. ... Desarrollo de software...">
            </div>
            <div class="form-group">
              <label for="remuneracion">Remuneración</label>
              <div class="radio-group">
                <div class="radio-item">
                  <label for="remuneracion-si">Sí</label>
                  <input type="radio" id="remuneracion-si" name="remuneracion" v-model="form.remuneracion" value="Sí">
                </div>
                <div class="radio-item">
                  <label for="remuneracion-no">No</label>
                  <input type="radio" id="remuneracion-no" name="remuneracion" v-model="form.remuneracion" value="No">
                </div>
              </div>
              <p>Salario a discutir en la entrevista</p>
            </div>
            <button type="submit" class="submit-button">Añadir</button>
          </form>
        </div>
        <!-- Agrega otros paneles aquí según sea necesario para editar y eliminar -->
      </div>
    </div>
  </div>
</template>

<script>
import Nav from './Nav.vue'; // Importa el componente Nav

export default {
  name: 'VacantesComponent',
  components: {
    Nav, 
  },
  data() {
    return {
      currentView: '', // Estado inicial vacío
      form: {
        nombrePuesto: '',
        descripcionPuesto: '',
        area: '',
        remuneracion: ''
      }
    };
  },
  methods: {
    submitForm() {
      console.log('Formulario enviado:', this.form);
      // Aquí muchacho pueden poner logica para enviar al backend...
    }
  }
}
</script>

<style scoped>

.background {
  height: 100vh;
  width: 100vw;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Estilo del panel de navegación superior */
.navigation-panel {
  display: flex;
  justify-content: center;
  background-color: #FFFFFF;
  padding: 10px 0;
  width: 60%;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  margin-top: 10px;
  gap: 100px;
  position: relative;
}

/* Estilo de los botones de navegación */
.nav-button {
  background: none;
  border: none;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  cursor: pointer;
  transition: color 0.3s ease, transform 0.3s ease;
  position: relative;
  overflow: hidden;
}

.nav-button::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 4px;
  background-color: #007BFF;
  transition: width 0.3s ease;
}

.nav-button:hover::after {
  width: 100%;
}

.nav-button:hover {
  color: #007BFF;
}

/* Estilo del contenido principal de la página */
.main-content {
  width: 100%;
  display: flex;
  margin-top: 20px;
}

/* Estilo del panel izquierdo con los botones de las vistas */
.left-panel {
  flex: 0 0 250px;
  padding: 20px;
  gap: 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-right: 30px;
}

/* Estilo de los contenedores de cada botón de vista */
.vacante {
  cursor: pointer;
  margin-left: 25px;
}

/* Estilo general para los círculos (bolas) que representan las vistas */
.circle {
  background-color: #333;
  color: white;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

/* Estilo para el círculo activo (color azul) */
.circle.active {
  background-color: #5a8dee;
}

.circle:hover {
  background-color: #555;
}

/* Estilo del panel derecho que contiene el formulario */
.right-panel {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

/* Estilo del contenedor del formulario */
.form-container {
  width: 50%;
  max-width: 600px;
  margin: 0 auto;
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-left: 150px;
}

/* Estilo de los grupos de formularios */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

/* Estilo de los inputs y textarea */
.form-group input,
.form-group textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

.form-group textarea {
  resize: none;
}

/* Estilos específicos para la opción de remuneración */
.radio-group {
  display: flex;
  gap: 30px;
  margin-bottom: 10px;
}

.radio-item {
  display: flex;
  align-items: center;
}

.radio-item label {
  margin-right: 5px;
}

.radio-item input[type="radio"] {
  margin-left: 5px;
}

/* Estilo para la nota debajo de las opciones de remuneración */
p {
  font-style: italic;
  font-size: 0.9em;
}

/* Estilo para el botón de envío del formulario */
.submit-button {
  background-color: #333;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #555;
}

</style>
