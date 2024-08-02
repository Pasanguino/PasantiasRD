<template>
    <div class="modal">
      <div class="modal-content">
        <h2>Editar Vacante</h2>
        <form @submit.prevent="submitForm">
          <input type="text" v-model="company" placeholder="Empresa" required>
          <input type="text" v-model="title" placeholder="Título" required>
          <input type="date" v-model="date" placeholder="Fecha" required>
          <button type="submit">Guardar</button>
          <button type="button" @click="$emit('close')">Cerrar</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      vacancy: Object
    },
    data() {
      return {
        company: this.vacancy.company,
        title: this.vacancy.title,
        date: this.vacancy.date
      };
    },
    methods: {
      submitForm() {
        this.$emit('edit-vacancy', {
          id: this.vacancy.id,
          company: this.company,
          title: this.title,
          date: this.date
        });
      }
    }
  }
  </script>
  
  <style scoped>
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
  }
  form input {
    display: block;
    margin: 10px 0;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
  }
  form button {
    padding: 10px 20px;
    margin: 10px 5px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  form button:hover {
    background-color: #0056b3;
  }
  </style>
  