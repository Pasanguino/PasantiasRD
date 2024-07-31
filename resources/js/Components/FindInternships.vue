<template>
  <div class="cantidad_vacantes">
    <div class="titulo">
      <h1>Encuentra pasantías</h1>
      <h2>Descubre las pasantías más destacadas de tu área de estudio.</h2>
    </div>
    <div class="carousel-container">
      <div class="custom-carousel-wrapper">
        <div class="custom-carousel">
          <Carousel :autoplay="5000" :wrap-around="true" :settings="carouselSettings" :breakpoints="carouselBreakpoints">
            <template #addons>
              <div class="carousel-navigation">
                <Navigation class="nav-left" @click="prevSlide" />
                <Navigation class="nav-right" @click="nextSlide" />
              </div>
            </template>

            <Slide v-for="(slide, index) in slides" :key="index">
              <div class="slide-content">
                <div class="header">
                  <img :src="slide.image" alt="Company logo" class="logo">
                  <div>
                    <h3 class="title">{{ slide.title }}</h3>
                    <p class="company">{{ slide.company }}</p>
                  </div>
                </div>
                <p class="content">{{ slide.content }}</p>
                <p class="location">{{ slide.location }}</p>
                <p class="date">{{ slide.date }}</p>
              </div>
            </Slide>
          </Carousel>
        </div>
      </div>
    </div>
    <div class="ver-mas">
      <button @click="irAPasantias">Ver todas las pasantías</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

const slides = ref([
  { title: 'Asistente de Marketing Digital', content: 'Ayuda a desarrollar estrategias de marketing en línea.', location: 'Santo Domingo', date: '01/07/2024', company: 'Marketing Solutions Ltd.', image: '/images/Empresas/MarketingSolutionsLtd.jpeg' },
  { title: 'Analista de Datos Junior', content: 'Colabora en la recopilación y análisis de datos.', location: 'Santo Domingo', date: '02/07/2024', company: 'DataTech Analytics', image: '/images/Empresas/DataTechAnalytics.jpeg' },
  { title: 'Desarrollador de Software en Prácticas', content: 'Participa en proyectos de desarrollo de software.', location: 'Santo Domingo', date: '03/07/2024', company: 'Tech Innovations Inc.', image: '/images/Empresas/TechInnovationsInc.jpeg' },
  { title: 'Asistente de Recursos Humanos', content: 'Apoya en el proceso de reclutamiento y gestión de personal.', location: 'Santo Domingo', date: '04/07/2024', company: 'People Management Solutions', image: '/images/Empresas/PeopleManagementSolutions.jpeg' },
  { title: 'Diseñador Gráfico en Prácticas', content: 'Crea contenido visual para campañas publicitarias.', location: 'Santo Domingo', date: '05/07/2024', company: 'Creative Designs Agency', image: '/images/Empresas/CreativeDesignsAgency.jpeg' },
  { title: 'Asistente de Finanzas', content: 'Ayuda en la elaboración de presupuestos y análisis financiero.', location: 'Santo Domingo', date: '06/07/2024', company: 'Finance Experts Group', image: '/images/Empresas/FinanceExpertsGroup.jpeg' },
  { title: 'Consultor Junior', content: 'Participa en proyectos de consultoría y elaboración de informes.', location: 'Santo Domingo', date: '07/07/2024', company: 'Consulting Professionals Ltd.', image: '/images/Empresas/ConsultingProfessionalsLtd.jpeg' },
  { title: 'Investigador en Laboratorio', content: 'Trabaja en proyectos de investigación científica.', location: 'Santo Domingo', date: '08/07/2024', company: 'Scientific Research Institute', image: '/images/Empresas/ScientificResearchInstitute.jpeg' },
  { title: 'Pasante de Arquitectura', content: 'Colabora en proyectos de diseño y construcción.', location: 'Santo Domingo', date: '09/07/2024', company: 'Architectural Design Studio', image: '/images/Empresas/ArchitecturalDesignStudio.jpeg' },
]);

const irAPasantias = () => {
  window.location.href = '/Internships';
};

// Configuración del carrusel y breakpoints
const carouselSettings = {
  itemsToShow: 3, // Mostrar 3 tarjetas completas
  wrapAround: true,
};

const carouselBreakpoints = {
  800: {
    itemsToShow: 2,
    wrapAround: true,
  },
};

// Funciones para navegar por el carrusel
const carouselRef = ref(null);

const nextSlide = () => {
  carouselRef.value.next();
};

const prevSlide = () => {
  carouselRef.value.prev();
};

</script>

<style scoped>
.cantidad_vacantes {
  margin-top: 50px;
  background-color: #f0f0f0;
  display: flex;
  flex-direction: column;
  padding: 50px 60px;
}

.titulo {
  text-align: center;
}

.titulo h1 {
  color: #7d98f8;
  font-weight: bold;
  font-size: 30px;
}

.titulo h2 {
  color: #1d1d1d;
  font-weight: bold;
  font-size: 25px;
}

.carousel-container {
  margin: 0 auto;
  max-width: 90%;
  position: relative; /* Posición relativa para contener el carrusel */
  margin-top: 40px;
}

.custom-carousel-wrapper {
  position: relative; /* Posición relativa para contener el carrusel */
}

.custom-carousel {
  width: 100%;
  position: relative; /* Posición relativa para que los hijos respeten el espacio */
  margin-bottom: 10px; /* Separación opcional entre el carrusel y otros elementos */
}

.slide-content {
  padding: 1rem;
  text-align: left;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  margin-right: 20px; /* Ajusta el margen derecho para separar las tarjetas */
}

.slide-content:last-child {
  margin-right: 0; /* Elimina el margen derecho del último elemento */
}

.slide-content .header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.slide-content .logo {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 1rem;
}

.slide-content .title {
  font-size: 1.25rem;
  font-weight: bold;
  color: #1d1d1d;
}

.slide-content .company {
  font-size: 1rem;
  color: #777;
  margin-bottom: 0.5rem;
}

.slide-content .content {
  font-size: 1rem;
  color: #333;
  margin-bottom: 0.5rem;
}

.slide-content .location {
  font-size: 0.875rem;
  color: #777;
}

.slide-content .date {
  font-size: 0.875rem;
  color: #7d98f8;
  font-weight: bold;
}

.carousel-navigation {
  position: absolute;
  top: 50%; /* Ajusta la posición vertical según sea necesario */
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  width: 100%;
  z-index: 100; /* Asegura que esté sobre el carrusel */
}

.carousel-navigation .nav-left,
.carousel-navigation .nav-right {
  font-size: 24px; /* Tamaño de las flechas */
  color: #333; /* Color de las flechas */
  cursor: pointer; /* Cambia el cursor a mano */
}

.carousel-navigation .nav-left {
  left: 20px; /* Ajusta la posición de la flecha izquierda */
}

.carousel-navigation .nav-right {
  right: 20px; /* Ajusta la posición de la flecha derecha */
}

.ver-mas {
  display: flex;
  justify-content: center;
  margin-top: 40px; /* Aumentado el margen superior */
  margin-bottom: 60px; /* Aumentado el margen inferior */
}

.ver-mas button {
  margin-top: 40px;
  padding: 10px 20px;
  font-size: 16px;
  color: #fff;
  background-color: #7d98f8;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.ver-mas button:hover {
  background-color: #5a78c8;
}
</style>























