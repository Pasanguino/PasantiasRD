<template>
  <div class="modal">
    <div class="modal-content">
      <h2>Editar Vacante</h2>
      <form @submit.prevent="submitForm">
        <input
          type="text"
          v-model="company"
          placeholder="Empresa"
          required
        />
        <input
          type="text"
          v-model="title"
          placeholder="Título"
          required
        />
        <input
          type="date"
          v-model="date"
          placeholder="Fecha"
          required
        />
        <button type="submit">Guardar</button>
        <button type="button" @click="closeModal">Cerrar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps({
  vacancy: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['edit-vacancy', 'close']);

const company = ref(props.vacancy.company);
const title = ref(props.vacancy.title);
const date = ref(props.vacancy.date);

watch(() => props.vacancy, (newVacancy) => {
  company.value = newVacancy.company;
  title.value = newVacancy.title;
  date.value = newVacancy.date;
}, { immediate: true });

const submitForm = () => {
  emit('edit-vacancy', {
    id: props.vacancy.id,
    company: company.value,
    title: title.value,
    date: date.value
  });
};

const closeModal = () => {
  emit('close');
};
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
  z-index: 1000;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

form input {
  display: block;
  margin: 10px 0;
  padding: 10px;
  width: calc(100% - 22px);
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
