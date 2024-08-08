<template>
    <div class="vacancy-card">
      <div class="company-logo">{{ company }}</div>
      <div class="vacancy-details">
        <h3>{{ title }}</h3>
        <p>{{ date }}</p>
      </div>
      <button @click="onEdit">Editar</button>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      id: Number,
      company: String,
      title: String,
      date: String
    },
    methods: {
      onEdit() {
        this.$emit('edit-vacancy', this.id);
      }
    }
  }
  </script>
  
  <style scoped>
  .vacancy-card {
    padding: 15px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    border-radius: 5px;
  }
  button {
    margin-top: 10px;
    padding: 5px 10px;
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
  
  