<template>
  <div class="background">
    <Nav :auth="auth"></Nav>
    <div class="navigation-panel">
      <button class="nav-button" @click="currentView = 'PublicarVacantes'">Publicar vacantes</button>
      <button class="nav-button" @click="currentView = 'VacantesAñadidas'">Vacantes añadidas</button>
    </div>
    <div class="main-content">
      <div class="right-panel">
        <!-- Formulario para publicar o editar vacantes -->
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
            <button type="submit" class="submit-button">{{ editingVacante ? 'Actualizar' : 'Añadir' }}</button>
          </form>
        </div>

        <!-- Mostrar vacantes añadidas -->
<div v-if="currentView === 'VacantesAñadidas'" class="vacantes-list">
  <div v-for="vacante in vacantes" :key="vacante.id" class="vacante-item">
    <div class="vacante-details">
      <h3>{{ vacante.vacancy_name }}</h3>
      <p>{{ vacante.vacancy_description }}</p>
      <p>Salario: {{ vacante.salary }}</p>
    </div>
    <div class="vacante-actions">
      <button @click="editVacante(vacante)" class="vacante-edit-btn">Editar</button>
      <button @click="deleteVacante(vacante.id)" class="vacante-delete-btn">Eliminar</button>
      <button @click="viewEstudiantesPostulados(vacante.id)" class="vacante-view-students-btn">Ver Estudiantes</button> <!-- Nuevo botón -->
    </div>
  </div>
</div>

        <!-- Mostrar cantidad de estudiantes -->
        <div v-if="currentView === 'Estudiantes'" class="estudiantes-panel">
          <h2>Cantidad de Estudiantes</h2>
          <p ref="counter">{{ estudiantesCount }}</p>
        </div>

        <!-- Mostrar estudiantes postulados -->
<div v-if="currentView === 'EstudiantesPostulados'" class="estudiantes-postulados-panel">
  <h2>Estudiantes Postulados</h2>
  <div v-if="estudiantesPostulados.length">
    <div v-for="estudiante in estudiantesPostulados" :key="estudiante.id" class="estudiante-item">
      <div class="estudiante-details">
        <h4>{{ estudiante.nombre }}</h4>
        <p>Currículo: {{ estudiante.curriculo }}</p>
      </div>
      <div class="estudiante-actions">
        <button @click="aceptarEstudiante(estudiante.id)" class="estudiante-aceptar-btn">Aceptar</button>
        <button @click="rechazarEstudiante(estudiante.id)" class="estudiante-rechazar-btn">Rechazar</button>
      </div>
    </div>
  </div>
  <div v-else>
    <p>No hay estudiantes postulados.</p>
  </div>
</div>

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Nav from './Nav.vue'; // Importa el componente Nav

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
      currentView: 'PublicarVacantes', // Estado inicial con la vista predeterminada
      form: {
        nombrePuesto: '',
        descripcionPuesto: '',
        area: '',
        remuneracion: ''
      },
      vacantes: [], // Vacantes activas
      editingVacante: null, // Vacante actualmente en edición
      estudiantesCount: 0, // Conteo de estudiantes
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('/vacancies', {
          vacancy_name: this.form.nombrePuesto,
          vacancy_description: this.form.descripcionPuesto,
          salary: this.form.remuneracion === 'Sí' ? 80000 : 0, // Ajusta según la lógica de salario
          company_name: 'Default Company', // Ajusta según la lógica de la empresa
          company_id: 1, // Ajusta según la lógica de la empresa
          user_id: 1, // Ajusta según la lógica del usuario
          province_id: 1, // Ajusta según la lógica de la provincia
          area_id: 1, // Ajusta según la lógica del área
          position_id: 1 // Ajusta según la lógica de la posición
        });

          this.vacantes.push(response.data.vacante);
          console.log('Vacante añadida:', response.data.vacante);
        }

        this.resetForm();
      } catch (error) {
        console.error('Error al guardar la vacante:', error);
      }
    },
    async fetchVacantes() {
      try {
        const response = await axios.get('/vacancies');
        this.vacantes = response.data;
        console.log('Vacantes obtenidas:', this.vacantes); // Verifica los datos recibidos
      } catch (error) {
        console.error('Error al obtener las vacantes:', error);
      }
    },
    async fetchEstudiantes() {
      try {
        const response = await axios.get('/api/estudiantes'); // Ruta para obtener estudiantes
        this.estudiantesCount = response.data.estudiantes;
        console.log('Estudiantes obtenidos:', this.estudiantesCount); // Verifica los datos recibidos
        
        // Configura el Intersection Observer después de actualizar los datos
        this.setupObserver();
      } catch (error) {
        console.error('Error al obtener estudiantes:', error);
      }
    },
    async updateVacante() {
      try {
        const response = await axios.put(`/vacancies/${this.selectedVacancy.id}`, {
          vacancy_name: this.selectedVacancy.vacancy_name,
          vacancy_description: this.selectedVacancy.vacancy_description,
          salary: this.selectedVacancy.salary,
          company_name: 'Default Company', // Ajusta según la lógica de la empresa
          company_id: 1, // Ajusta según la lógica de la empresa
          user_id: 1, // Ajusta según la lógica del usuario
          province_id: 1, // Ajusta según la lógica de la provincia
          area_id: 1, // Ajusta según la lógica del área
          position_id: 1 // Ajusta según la lógica de la posición
        });

        // Actualiza la vacante en la lista
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

    async fetchEstudiantesPostulados(vacanteId) {
      try {
        const response = await axios.get(`/vacancies/${vacanteId}/applicants`);
        this.estudiantesPostulados = response.data;
        this.currentView = 'EstudiantesPostulados'; // Cambia a la vista de estudiantes postulados
      } catch (error) {
        console.error('Error al obtener estudiantes postulados:', error);
      }
    },

    async aceptarEstudiante(estudianteId) {
      try {
        await axios.post(`/students/${estudianteId}/accept`);
        this.estudiantesPostulados = this.estudiantesPostulados.filter(estudiante => estudiante.id !== estudianteId);
        console.log('Estudiante aceptado:', estudianteId);
      } catch (error) {
        console.error('Error al aceptar estudiante:', error);
      }
    },

    async rechazarEstudiante(estudianteId) {
      try {
        await axios.post(`/students/${estudianteId}/reject`);
        this.estudiantesPostulados = this.estudiantesPostulados.filter(estudiante => estudiante.id !== estudianteId);
        console.log('Estudiante rechazado:', estudianteId);
      } catch (error) {
        console.error('Error al rechazar estudiante:', error);
      }
    },
    editVacante(vacante) {
      this.editingVacante = vacante;
      this.form.nombrePuesto = vacante.vacancy_name;
      this.form.descripcionPuesto = vacante.vacancy_description;
      this.form.area = vacante.area;
      this.form.remuneracion = vacante.salary > 0 ? 'Sí' : 'No';
      this.currentView = 'PublicarVacantes'; // Cambia a la vista de formulario para editar
    },
    resetForm() {
      this.form = {
        nombrePuesto: '',
        descripcionPuesto: '',
        area: '',
        remuneracion: ''
      };
      this.editingVacante = null;
    }
  },
  mounted() {
    this.fetchVacantes(); // Cargar vacantes al iniciar
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
  width: 100%;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  margin-top: 0;
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
  flex-direction: column; /* Cambiado para el diseño en columnas */
  align-items: center;
  overflow: hidden;
  padding: 20px;
}

/* Estilo del contenedor del formulario */
.form-container {
  width: 80%; /* Ajusta el ancho del formulario según sea necesario */
  max-width: 600px; /* Máximo ancho del formulario */
  margin: 0 auto; /* Centrará el formulario horizontalmente */
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
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

/* Estilo del botón de envío */
.submit-button {
  background-color: #007BFF;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #0056b3;
}

/* Estilo de la lista de vacantes */
.vacantes-list {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 800px; /* Ancho máximo para la lista */
  margin: 0 auto; /* Centrará la lista horizontalmente */
  padding: 10px; /* Espaciado adicional */
}

.vacante-item {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
  gap: 10px; /* Espaciado entre elementos */
}

.vacante-details {
  flex: 1;
}

.vacante-actions {
  display: flex;
  gap: 10px; /* Espaciado entre botones */
}

.vacante-edit-btn,
.vacante-delete-btn {
  background-color: #007BFF;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #555;
}

</style>