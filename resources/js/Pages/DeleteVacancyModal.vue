<template>
    <div class="modal">
      <div class="modal-content">
        <h2>Eliminar Vacante</h2>
        <p>¿Estás seguro de que deseas eliminar esta vacante?</p>
        <button @click="confirmDelete">Eliminar</button>
        <button @click="$emit('close')">Cerrar</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      vacancy: Object
    },
    methods: {
      confirmDelete() {
        this.$emit('delete-vacancy', this.vacancy.id);
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
  button {
    padding: 10px 20px;
    margin: 10px 5px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  button:hover {
    background-color: #0056b3;
  }
  </style>
  