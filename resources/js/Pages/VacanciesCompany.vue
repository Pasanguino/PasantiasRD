<template>
  <div class="background">
    <Nav :auth="auth"></Nav>
    <div class="navigation-panel">
      <button class="nav-button" @click="currentView = 'PublicarVacantes'">Publicar vacantes</button>
      <button class="nav-button" @click="currentView = 'VacantesAñadidas'">Vacantes añadidas</button>
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
        <!-- Formulario para publicar vacantes -->
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

        <!-- Mostrar vacantes añadidas -->
        <div v-if="currentView === 'VacantesAñadidas'" class="vacantes-list">
          <div v-for="vacante in vacantes" :key="vacante.id" class="vacante-item">
            <h3>{{ vacante.vacancy_name }}</h3>
            <p>{{ vacante.vacancy_description }}</p>
            <p>Salario: {{ vacante.salary }}</p>
            <button @click="deleteVacante(vacante.id)">Eliminar</button>
          </div>
        </div>

        <!-- Mostrar vacantes eliminadas -->
        <div v-if="currentView === 'EliminarVacantes'" class="vacantes-list">
          <div v-for="vacante in vacantesEliminadas" :key="vacante.id" class="vacante-item">
            <h3>{{ vacante.vacancy_name }}</h3>
            <p>{{ vacante.vacancy_description }}</p>
            <p>Área: {{ vacante.area }}</p>
            <p>Salario: {{ vacante.salary }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Nav from './Nav_company.vue'; 

export default {
  name: 'VacantesComponent',
  components: {
    Nav, 
  },
  props: {
    auth: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      currentView: '', // Estado inicial vacío
      form: {
        nombrePuesto: '',
        descripcionPuesto: '',
        area: '',
        remuneracion: ''
      },
      vacantes: [], // Vacantes activas
      vacantesEliminadas: [], // Vacantes eliminadas
      selectedVacancy: null // Vacante seleccionada para edición
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('/vacancies', {
          vacancy_name: this.form.nombrePuesto,
          vacancy_description: this.form.descripcionPuesto,
          salary: this.form.remuneracion === 'Sí' ? 80000 : 0, 
          company_name: this.auth.user.company_name || 'Default Company', // Usar el valor de auth
          company_id: this.auth.user.company_id || 1, // Usar el valor de auth
          user_id: this.auth.user.id, // Usar el valor de auth
          province_id: 1, 
          area_id: 1, 
          position_id: 1 
        });

        this.vacantes.push(response.data.vacante);
        console.log('Vacante añadida:', response.data.vacante);
        this.resetForm();
      } catch (error) {
        console.error('Error al añadir la vacante:', error);
      }
    },
    async fetchVacantes() {
      try {
        const response = await axios.get('/vacancies');
        this.vacantes = response.data;
      } catch (error) {
        console.error('Error al obtener las vacantes:', error);
      }
    },
    async editVacante(id) {
      try {
        const response = await axios.get(`/vacancies/${id}`);
        this.selectedVacancy = response.data.vacante;
        this.currentView = 'EditarVacantes';
      } catch (error) {
        console.error('Error al obtener la vacante para editar:', error);
      }
    },
    async updateVacante() {
      try {
        const response = await axios.put(`/vacancies/${this.selectedVacancy.id}`, {
          vacancy_name: this.selectedVacancy.vacancy_name,
          vacancy_description: this.selectedVacancy.vacancy_description,
          salary: this.selectedVacancy.salary,
          company_name: this.auth.user.company_name || 'Default Company', 
          company_id: this.auth.user.company_id || 1, 
          user_id: this.auth.user.id, 
          province_id: 1, 
          area_id: 1, 
          position_id: 1 
        });

        const index = this.vacantes.findIndex(vacante => vacante.id === this.selectedVacancy.id);
        if (index !== -1) {
          this.vacantes[index] = response.data.vacante;
        }

        this.selectedVacancy = null;
        this.currentView = 'VacantesAñadidas';
        console.log('Vacante actualizada:', response.data.vacante);
      } catch (error) {
        console.error('Error al actualizar la vacante:', error);
      }
    },
    async deleteVacante(id) {
      try {
        await axios.delete(`/vacancies/${id}`);
        this.vacantes = this.vacantes.filter(vacante => vacante.id !== id);
        console.log('Vacante eliminada:', id);
      } catch (error) {
        console.error('Error al eliminar la vacante:', error);
      }
    },
    selectVacante(vacante) {
      this.selectedVacancy = { ...vacante };
      this.currentView = 'EditarVacantes';
    },
    resetForm() {
      this.form = {
        nombrePuesto: '',
        descripcionPuesto: '',
        area: '',
        remuneracion: ''
      };
    }
  },
  mounted() {
    this.fetchVacantes(); 
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
  flex-wrap: wrap;
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

/* Estilos responsivos */
@media (max-width: 1024px) {
  .navigation-panel {
    width: 80%;
    gap: 50px;
  }

  .left-panel {
    flex: 0 0 200px;
    margin-right: 20px;
  }

  .form-container {
    width: 70%;
    margin-left: 50px;
  }
}

@media (max-width: 768px) {
  .navigation-panel {
    width: 90%;
    gap: 30px;
    padding: 10px 5px;
    flex-wrap: wrap;
  }

  .main-content {
    flex-direction: column;
    align-items: center;
  }

  .left-panel {
    flex: 0 0 auto;
    margin-right: 0;
    align-items: center;
  }

  .circle {
    width: 120px;
    height: 120px;
    font-size: 14px;
  }

  .form-container {
    width: 80%;
    margin-left: 0;
  }
}

@media (max-width: 480px) {
  .navigation-panel {
    width: 100%;
    gap: 10px;
    flex-direction: column;
  }

  .nav-button {
    font-size: 14px;
    padding: 5px 10px;
  }

  .left-panel {
    width: 100%;
    align-items: center;
    margin-bottom: 20px;
  }

  .circle {
    width: 100px;
    height: 100px;
    font-size: 12px;
  }

  .form-container {
    width: 90%;
  }

  .form-group input,
  .form-group textarea {
    font-size: 12px;
  }

  .submit-button {
    padding: 8px 12px;
    font-size: 14px;
  }
}

</style>
