<!-- ComponentePrincipal.vue -->
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Provincias from "@/Components/Specific/Provincias.vue";

const datosTarjetas = ref([]);
const mostrarTodo = ref(false);

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

const toggleMostrarTodo = () => {
    mostrarTodo.value = !mostrarTodo.value;
};
</script>

<template>
    <div class="cantidad_vacantes">

        <div class="contenedor-provincias">
            <Provincias v-for="(tarjeta, indice) in mostrarTodo
                    ? datosTarjetas
                    : datosTarjetas.slice(0, 3)"
                :key="indice"
                :id="tarjeta.id"
                :imagen="tarjeta.imagen"
                :titulo="tarjeta.titulo"
                :contenido="tarjeta.contenido"
                :vacantes="tarjeta.vacantes"
                :companias="tarjeta.companias" />
        </div>
    </div>
    <div class="ver-mas">
        <button @click="toggleMostrarTodo" class="flex items-center">
            <span>
                {{
                    mostrarTodo
                        ? "Mostrar menos"
                        : "Ver todas las localizaciones"
                }}
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'transform rotate-180': mostrarTodo }"
                class="h-5 w-5 ml-2 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 13.293a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 1 1.414-1.414L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</template>

<style scoped>
* {
    transition: 0.5s;
}

.cantidad_vacantes {
    /* margin-top: 200px; */
    background-color: rgb(255, 255, 255);
    display: flex;
    flex-direction: column;

    /* Centrar el botón */
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
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    padding: 100px;
    transition: all 0.5s ease;
    /* Añadir transición para la animación */
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

.ver-mas{
    display: flex;
    justify-content: center;

}

.rotate-180 {
    transform: rotate(180deg);
}
</style>
