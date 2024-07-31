<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard de Empresas</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">¡Bienvenido al dashboard de empresas!</div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const jobCategories = ref([
    { id: 1, name: 'Atención al cliente', isOpen: false, jobs: [{ id: 1, title: 'Job 1' }, { id: 2, title: 'Job 2' }] },
    { id: 2, name: 'Soporte TI', isOpen: false, jobs: [{ id: 3, title: 'Job 3' }, { id: 4, title: 'Job 4' }] },
    { id: 3, name: 'Técnico', isOpen: false, jobs: [{ id: 5, title: 'Job 5' }, { id: 6, title: 'Job 6' }] },
  ]);
  
  const toggleCategory = (id) => {
    const category = jobCategories.value.find(category => category.id === id);
    category.isOpen = !category.isOpen;
  };
  
  const navigateTo = (page) => {
    // Implement navigation logic
    console.log(`Navigating to ${page}`);
  };
  </script>
  
  <style scoped>
  .dashboard {
    font-family: Arial, sans-serif;
  }
  header {
    display: flex;
    align-items: center;
    background-color: #4A5568;
    color: white;
    padding: 1rem;
  }
  .logo {
    width: 50px;
    margin-right: 1rem;
  }
  .title {
    font-size: 1.5rem;
  }
  nav {
    display: flex;
    justify-content: space-around;
    background-color: #F9A826;
    padding: 0.5rem;
  }
  main {
    padding: 1rem;
  }
  footer {
    background-color: #4A5568;
    color: white;
    padding: 1rem;
    text-align: center;
  }
  </style>
  