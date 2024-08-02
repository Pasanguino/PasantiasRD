<template>
  <div>
    <!-- Swiper Component -->


    <!-- Carousel Component -->
    <div class="cantidad_vacantes">
      <div class="titulo">
        <h1>Encuentra pasantías</h1>
        <h2>Descubre las pasantías más destacadas de tu área de estudio.</h2>
      </div>
      <div class="carousel-container">
        <!-- Swiper Carousel for Vacancies -->
       <swiper
  :slides-per-view="3"
  :space-between="30"
  pagination
  navigation
  autoplay="{ delay: 5000 }" 
  class="vacancies-swiper"
>
          <swiper-slide v-for="(slide, index) in slides" :key="index">
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
          </swiper-slide>
        </swiper>
      </div>
      <div class="ver-mas">
        <button @click="irAPasantias"> <a href="/estudiante"> Ver todas las pasantías</a> </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Swiper component setup
const onSwiper = (swiper) => {
  console.log(swiper);
};
const onSlideChange = () => {
  console.log('slide change');
};

// Carousel component setup
const slides = ref([
  { title: 'Asistente de Marketing Digital', content: 'Ayuda a desarrollar estrategias de marketing en línea.', location: 'Santo Domingo', date: '01/07/2024', company: 'Marketing Solutions Ltd.', image: '/images/Empresas/MarketingSolutionsLtd.jpeg' },
  { title: 'Analista de Datos Junior', content: 'Colabora en la recopilación y análisis de datos.', location: 'Santo Domingo', date: '02/07/2024', company: 'DataTech Analytics', image: '/images/Empresas/DataTechAnalytics.jpeg' },
  { title: 'Desarrollador de Software en Prácticas', content: 'Participa en proyectos de desarrollo de software.', location: 'Santo Domingo', date: '03/07/2024', company: 'Tech Innovations Inc.', image: '/images/Empresas/TechInnovationsInc.jpeg' },
  { title: 'Desarrollador de Software en Prácticas', content: 'Participa en proyectos de desarrollo de software.', location: 'Santo Domingo', date: '03/07/2024', company: 'Tech Innovations Inc.', image: '/images/Empresas/TechInnovationsInc.jpeg' },
  // Agrega más diapositivas aquí
]);

const irAPasantias = () => {
  window.location.href = '/Internships';
};
</script>

<style scoped>
/* Estilos específicos para Swiper */
.swiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Estilos específicos para Carousel */
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

.vacancies-swiper {
  width: 100%;
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

.swiper-button-next,
.swiper-button-prev {
  color: #333;
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
