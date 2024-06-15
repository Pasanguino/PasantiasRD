<template>
    <div class="faq-page">
      <Head title="Preguntas Más Frecuentes" />
      <div class="container">
        <h1>Preguntas frecuentes</h1>
        <div class="faq-item" v-for="(faq, index) in faqs" :key="index">
          <h2 @click="toggleFaq(index)" class="faq-question">
            {{ faq.question }}
          </h2>
          <div v-if="faq.open" class="faq-answer">
            <p>{{ faq.answer }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        faqs: [
          {
            question: '¿Cómo puedo crear una cuenta?',
            answer: 'Para crear una cuenta, haga clic en el botón de "Registrarse" en la parte superior de la página y complete el formulario con sus datos.',
            open: false
          },
          {
            question: '¿Cómo puedo restablecer mi contraseña?',
            answer: 'Para restablecer su contraseña, haga clic en "¿Olvidaste tu contraseña?" en la página de inicio de sesión y siga las instrucciones.',
            open: false
          },
          {
            question: '¿Cómo puedo contactar con el soporte técnico?',
            answer: 'Puede contactar con el soporte técnico a través de la página de "Contáctanos" o enviando un correo a soporte@example.com.',
            open: false
          }
        ]
      };
    },
    methods: {
      toggleFaq(index) {
        this.faqs[index].open = !this.faqs[index].open;
      }
    }
  };
  </script>
  
  <style scoped>
  @font-face {
      font-family: 'MyFont';
      src: url('../fonts/Retosta.otf') format('woff2');
  }
  
  .faq-page {
    background: rgb(89, 44, 3);
    background: linear-gradient(0deg, rgba(89, 44, 3, 1) 0%, rgba(191, 95, 7, 1) 100%);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }
  
  .container {
    width: 100%;
    max-width: 800px;
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
    color: #333;
  }
  
  .faq-item {
    margin-bottom: 15px;
  }
  
  .faq-question {
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    color: rgba(191, 95, 7, 1);
    margin: 0;
  }
  
  .faq-answer {
    padding: 10px 0;
    font-size: 16px;
    color: #555;
  }
  </style>
  