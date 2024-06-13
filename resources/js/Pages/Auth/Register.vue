<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Switch from '@/Components/Switch.vue';
import { ref, onMounted } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const tituloColor = ref('#F9A826'); // Color inicial del título
const tipo = ref('estudiante');

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const onEstudiante = () => {
    tituloColor.value = '#F9A826';
    tipo.value = 'estudiante';
};

const onOrganizacion = () => {
    tituloColor.value = '#4A5568';
    tipo.value = 'Organización';
};

onMounted(() => {
    document.documentElement.style.setProperty('--titulo-color', tituloColor.value);
});
</script>

<template>

    <Head title="Registro" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 contenido">
        <div class="container">
            <div class="titulo" style="display: grid; grid-template-columns: repeat(12, 1fr); align-items: center;">
                <div class="texto" style="grid-column: span 10;">
                    <h1 :style="{ color: tituloColor, margin: 0 }">Registro de {{ tipo }}</h1>
                </div>
                <div class="switch" style="grid-column: span 2; justify-self: end;">
                    <Switch :onEstudiante="onEstudiante" :onOrganizacion="onOrganizacion" />
                </div>
            </div>

            <div v-if="tipo === 'estudiante'" class="Estudiante">
                <h1>ESTA ES LA DE ESTUDIANTE</h1>
            </div>
            <div v-else class="Organización">
                <h1>ESTA ES LA DE ORGANIZACION</h1>
            </div>
        </div>
    </div>
</template>

<style>
.contenido {
    background: rgb(89, 44, 3);
    background: linear-gradient(0deg, rgba(89, 44, 3, 1) 0%, rgba(191, 95, 7, 1) 100%);
}

.container {
    width: 45%;
    padding: 20px;
    background-color: rgb(255, 255, 255);
    border-radius: 36px;
    margin: 0 auto;
}

.titulo {
    display: grid;
    grid-template-columns: 10fr 2fr;
    align-items: center;
}

.texto {
    grid-column: 1;
    display: flex;
    justify-content: start;
    align-items: center;
}

.switch {
    grid-column: 2;
    text-align: right;
    display: flex;
    justify-content: center;
    align-items: center;
}

.texto h1 {
    margin: 0;
    font-size: 35px;
    font-weight: 900;
    letter-spacing: 0.5px;
    color: #fff;
    text-transform: uppercase;
}

/* Media query para dispositivos con ancho menor a 768px (ejemplo: tablet y móvil) */
@media (max-width: 1200px) {
    .container {
        width: 100%;
    }

    .titulo {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .switch {
        grid-column: initial;
        margin-top: 10px;
        text-align: center;
    }
}
</style>
