<!-- ComponentePrincipal.vue -->
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Provincias from "@/Components/Specific/Provincias.vue";

const datosTarjetas = ref([]);

const fetchProvinceData = async () => {
    try {
        const response = await axios.get('/province-data');
        const data = response.data;

        datosTarjetas.value = data.map(province => ({
            id: province.province_id,
            imagen: `/images/Provincias/${province.province_name.replace(/ /g, '')}.png`,
            titulo: province.province_name,
            contenido: `Vacantes: ${province.vacancy_count}, Compañías: ${province.company_count}`,
            vacantes: province.vacancy_count,
            companias: province.company_count,
        }));
    } catch (error) {
        console.error("Error fetching province data:", error);
    }
};

onMounted(fetchProvinceData);
</script>

<template>
    <div class="cantidad_vacantes">
        <div class="contenedor-provincias">
            <Provincias
                v-for="(tarjeta, indice) in datosTarjetas"
                :key="indice"
                :id="tarjeta.id"
                :imagen="tarjeta.imagen"
                :titulo="tarjeta.titulo"
                :contenido="tarjeta.contenido"
                :vacantes="tarjeta.vacantes"
                :companias="tarjeta.companias" />
        </div>
    </div>
</template>


<style scoped>
* {
    transition: 0.5s;
}

.cantidad_vacantes {
    background-color: rgb(255, 255, 255);
    display: flex;
    flex-direction: column;
    width: 100%;
}

.titulo {
    text-align: center;
}

.titulo h1 {
    color: #7d98f8;
    font-weight: bold;
    font-size: 30px;
}

.titulo h2 {
    color: #1d1d1d;
    font-weight: bold;
    font-size: 25px;
}

.contenedor-provincias {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); /* Ancho aumentado */
    gap: 30px;
    padding: 100px;
    transition: all 0.5s ease;
}

@media (max-width: 600px) {
    .contenedor-provincias {
        grid-template-columns: 1fr;
    }
}

button {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #7d98f8;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    transform: translate(0, -50px);
}

button:hover {
    background-color: #5a78c8;
}

.ver-mas {
    display: flex;
    justify-content: center;
}

.rotate-180 {
    transform: rotate(180deg);
}

/* Estilos para las tarjetas, si es necesario */
.card {
    padding: 20px; /* Ajusta el padding según sea necesario */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
</style>
