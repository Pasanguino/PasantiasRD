<template>
  <section class="cantidades">
    <div class="item" v-for="(item, index) in items" :key="index">
      <h1>{{ item.label }}</h1>
      <p ref="counter" :id="'counter-' + index">{{ item.value }}</p>
    </div>
  </section>
</template>

<script>
import { CountUp } from 'countup.js'; // Importa CountUp.js
import axios from 'axios'; // Importa Axios para realizar solicitudes HTTP

export default {
  name: 'Cantidades',
  data() {
    return {
      items: [
        { label: 'Reclutadores', value: 0 },
        { label: 'Vacantes', value: 0 },
        { label: 'Postulantes', value: 0 },
        { label: 'Estudiantes', value: 0 },
      ],
    };
  },
  mounted() {
    // Realiza la solicitud a la API
    axios.get('/count')
      .then(response => {
        // Actualiza los valores con la respuesta de la API
        this.items = [
          { label: 'Reclutadores', value: response.data.reclutadores },
          { label: 'Vacantes', value: response.data.vacantes },
          { label: 'Postulantes', value: response.data.postulantes },
          { label: 'Estudiantes', value: response.data.estudiantes },
        ];

        // Configura el Intersection Observer después de actualizar los datos
        this.setupObserver();
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  },
  methods: {
    setupObserver() {
      // Configura el Intersection Observer
      const options = {
        root: null, // Observa el viewport
        rootMargin: '0px',
        threshold: 0.1, // 10% del elemento debe estar visible
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // Inicia la animación si el elemento es visible
            const index = entry.target.dataset.index;
            const element = this.$refs.counter[index];
            new CountUp(element, this.items[index].value).start();
            
            // Deja de observar después de iniciar la animación
            observer.unobserve(entry.target);
          }
        });
      }, options);

      // Observa todos los elementos con el ref 'counter'
      this.$refs.counter.forEach((element, index) => {
        element.dataset.index = index;
        observer.observe(element);
      });
    },
  },
}
</script>

<style scoped>
.cantidades {
  position: relative;
  background-image: url("/images/trabajo.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  background-attachment: fixed;
  height: 400px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 20px;
}

.cantidades::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

.cantidades .item {
  position: relative;
  z-index: 2;
  text-align: center;
}

.item h1 {
  margin: 0;
  font-size: 50px;
  font-weight: bold;
  color: white;
}

.item p {
  font-family: 'Lilita One', sans-serif;
  font-weight: bold;
  font-size: 70px;
  margin: 0;
  color: #6699ff;
}

@media (max-width: 1000px) {
  .cantidades {
    flex-direction: column;
    justify-content: center;
    height: auto;
  }

  .item {
    margin-bottom: 20px;
  }

  .item:last-child {
    margin-bottom: 0;
  }
}
</style>
