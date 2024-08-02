<template>
    <div class="sidebar">
      <button @click="emitAction('add')">Añadir vacantes</button>
      <button @click="emitAction('edit')">Editar vacantes</button>
      <button @click="emitAction('delete')">Eliminar vacantes</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      emitAction(action) {
        this.$emit('action', action);
      }
    }
  }
  </script>
  
  <style scoped>
  .sidebar {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  button {
    padding: 10px;
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
  