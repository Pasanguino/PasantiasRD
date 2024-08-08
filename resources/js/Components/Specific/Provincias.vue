<!-- Provincias.vue -->
<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    id: Number,
    imagen: String,
    titulo: String,
    contenido: String,
    vacantes: Number,
    companias: Number
});
</script>

<template>
    <a :href="`/vacancies_province/${id}`">

    
    <div class="tarjeta">
        <div class="imagen">
            <img :src="imagen" :alt="titulo">
        </div>
        <h1>{{ titulo }}</h1>
        <!-- <p>{{ contenido }}</p> -->

        <div class="datos">
            <div class="vacantes">{{ vacantes }} Vacantes</div>
            <div class="companias">{{ companias }} Compañias</div>
        </div>
    </div>
    </a>

</template>

<style scoped>
.tarjeta {
    background-color: #f57b083f;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.tarjeta:hover{
    background-color: #f57b08;
    transform: scale(1.1);
}

.tarjeta img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    margin-bottom: 20px;
    border-radius: 4px;
    background-color: aqua;
}

.tarjeta h1 {
    font-size: 30px;
    font-weight: bold;
    color: #242424;
}

.tarjeta:hover h1 {

    color: #ffffff;
    transform: scale(1.01);
}

.datos {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.vacantes,
.companias {
    font-size: 16px;
    color: #333333;
}
</style>
