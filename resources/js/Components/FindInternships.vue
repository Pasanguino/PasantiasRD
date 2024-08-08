<template>
  <div class="container">
        <div class="titulo">
        <h1>Encuentra pasantías</h1>
        <h2>Descubre las pasantías más destacadas de tu área de estudio.</h2>
      </div>
  <div class="swiper-container">
    <!-- Custom Previous Button -->
    <button class="prev-button" @click="slidePrev">
      <i class="fas fa-chevron-left"></i>
    </button>
    
    <!-- Swiper Component -->
    <swiper
      ref="swiper"
      :pagination="true"
      :slides-per-view="1"
      :space-between="30"
      :loop="true"
      :autoplay="autoplay"
      :modules="modules"
      :breakpoints="breakpoints"
      class="mySwiper"
      @swiper="onSwiper"
    >
           <swiper-slide v-for="(slide, index) in slides" :key="index">
              <div class="slide-content">
             <a :href="'/vacante/' + slide.id">
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
                </a>
              </div>
            </swiper-slide>
    </swiper>
    
    <!-- Custom Next Button -->
    <button class="next-button" @click="slideNext">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
        <div class="ver-mas">
        <button @click="irAPasantias"> <a href="/estudiante"> Ver todas las pasantías</a> </button>
      </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';
import 'swiper/css/pagination';
import { Navigation, Autoplay, Pagination } from 'swiper/modules';

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    const swiperInstance = ref(null);
    const slides = ref([]);

    const onSwiper = (swiper) => {
      swiperInstance.value = swiper;
    };

    const slideNext = () => {
      if (swiperInstance.value) {
        swiperInstance.value.slideNext();
      }
    };

    const slidePrev = () => {
      if (swiperInstance.value) {
        swiperInstance.value.slidePrev();
      }
    };

    // Fetch data from API on component mount
    onMounted(async () => {
      try {
        const response = await axios.get('/vacancies_data');
        slides.value = response.data.slice(0, 30).map(vacancy => ({
          id: vacancy.id,
          title: vacancy.vacancy_name,
          content: vacancy.vacancy_description,
          location: vacancy.province.province_name,
          date: new Date(vacancy.created_at).toLocaleDateString(),
          company: vacancy.company_name,
          image: '/images/logo.png' // Imagen genérica para todas las vacantes
        }));
      } catch (error) {
        console.error('Error fetching vacancies data:', error);
      }
    });

    const breakpoints = {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    };

    return {
      slideNext,
      slidePrev,
      onSwiper,
      slides,
      modules: [Navigation, Autoplay, Pagination],
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      breakpoints,
    };
  },
};
</script>

<style scoped>



@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

.container{
  width: 100%;
  margin: 100px auto;
  background-color: rgba(0, 0, 0, 0.075);
  padding: 20px;
}

.swiper-container {
  position: relative;
  width: 100%;
  height: 300px;
  display: flex;
  align-items: center;
}

.mySwiper {
  width: 100%;
  height: 300px;
  flex-grow: 1;
}

.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
}

.swiper-slide img {
  width: 100%;
  height: auto;
}

.prev-button,
.next-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 10;
  font-size: 18px;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.prev-button {
  left: 10px;
}

.next-button {
  right: 10px;
}

.prev-button:hover,
.next-button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

.swiper-container {
  position: relative;
  width: 100%;
  height: auto;
  display: flex;
  align-items: center;
  margin-top: 50px;
}

.mySwiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

.slide-content {
  padding: 1rem;
  text-align: left;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 230px;
  width: 100%;
  margin-right: 20px;
}

.slide-content:last-child {
  margin-right: 0;
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

.prev-button,
.next-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 10;
  font-size: 18px;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.prev-button {
  left: 10px;
}

.next-button {
  right: 10px;
}

.prev-button:hover,
.next-button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

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
  position: relative;
  margin-top: 40px;
}

.vacancies-swiper {
  width: 100%;
}

.ver-mas {
  display: flex;
  justify-content: center;
  margin-top: 40px;
  margin-bottom: 60px;
}

.ver-mas button {
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

.ver-mas button a {
  color: #fff;
  text-decoration: none;
}

</style>
