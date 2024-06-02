<template>
    <input class="border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm" v-model="model"
        ref="input" />
</template>

<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<style scoped>
.custom-focus-border:focus {
    border-color: #ff5215;
    /* Color personalizado para el borde */
}

.custom-focus-ring:focus {
    outline: none;
    /* Eliminar el outline predeterminado */
    box-shadow: 0 0 0 2px #ff5215;
    /* Simular anillo de enfoque con color personalizado */
}
</style>
