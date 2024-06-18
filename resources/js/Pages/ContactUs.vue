<template>
    <div class="contact-page">
      <Head title="Contáctanos" />
      <div class="container">
        <div class="contact-form">
          <h1>Contáctanos</h1>
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input
                id="name"
                type="text"
                v-model="form.name"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input
                id="email"
                type="email"
                v-model="form.email"
                required
              />
            </div>
            <div class="form-group">
              <label for="subject">Asunto</label>
              <input
                id="subject"
                type="text"
                v-model="form.subject"
                required
              />
            </div>
            <div class="form-group">
              <label for="message">Mensaje</label>
              <textarea
                id="message"
                v-model="form.message"
                required
              ></textarea>
            </div>
            <div class="form-group">
              <button type="submit" :disabled="loading">Enviar</button>
            </div>
          </form>
          <div v-if="status" class="status-message">{{ status }}</div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          subject: '',
          message: ''
        },
        loading: false,
        status: ''
      };
    },
    methods: {
      async submitForm() {
        this.loading = true;
        this.status = '';
        try {
          // Simular una solicitud de envío de formulario
          await new Promise(resolve => setTimeout(resolve, 1000));
          this.status = 'Mensaje enviado con éxito.';
          this.form.name = '';
          this.form.email = '';
          this.form.subject = '';
          this.form.message = '';
        } catch (error) {
          this.status = 'Hubo un error al enviar el mensaje.';
        } finally {
          this.loading = false;
        }
      }
    }
  };
  </script>
  
  <style scoped>
  @font-face {
      font-family: 'MyFont';
      src: url('../fonts/Retosta.otf') format('woff2');
  }
  
  .contact-page {
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
    max-width: 600px;
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .contact-form {
    width: 100%;
  }
  
  .contact-form h1 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
    color: #333;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }
  
  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .form-group textarea {
    resize: vertical;
    min-height: 100px;
  }
  
  .form-group button {
    width: 100%;
    padding: 10px;
    background: rgba(191, 95, 7, 1);
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .form-group button:disabled {
    background: #ccc;
  }
  
  .status-message {
    margin-top: 20px;
    font-size: 16px;
    color: green;
    text-align: center;
  }
  </style>
  