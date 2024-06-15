<script setup>

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel(reg).vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import TextInput from '@/Components/TextInput.vue';






import { Head, useForm } from '@inertiajs/vue3';
import Switch from '@/Components/Switch.vue';
import { ref, onMounted } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const fondoColor = ref('#7D98F8');
const tituloColor = ref('#C8871F'); // Color inicial del título
const tipo = ref('estudiante');
const img = ref('/images/graduation.svg');

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const onEstudiante = () => {
    tituloColor.value = '#F9A826';
    tipo.value = 'estudiante';
    fondoColor.value = '#7D98F8';
    img.value = '/images/graduation.svg';

    
};

const onOrganizacion = () => {
    tituloColor.value = '#4A5568';
    fondoColor.value = '#F9A826';
    tipo.value = 'Organización';
    img.value = '/images/production.svg';
};

onMounted(() => {
    document.documentElement.style.setProperty('--titulo-color', tituloColor.value);
});



</script>

<template>

    <Head title="Registro" />


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100  contenedor"
        :style="{ backgroundColor: fondoColor }">

        <img :src="img" alt="" class="fondo">
        <div class="container ">
            <div class="titulo" style="display: grid; grid-template-columns: repeat(12, 1fr); align-items: center;">
                <div class="texto" style="grid-column: span 10;">
                    <h1 :style="{ color: tituloColor, margin: 0 }">Registro de {{ tipo }}</h1>
                </div>
                <div class="switch" style="grid-column: span 2; justify-self: end;">
                    <Switch :onEstudiante="onEstudiante" :onOrganizacion="onOrganizacion" />
                </div>
            </div>

            <div v-if="tipo === 'estudiante'" class="Estudiante">

                <form @submit.prevent="submit">
                    <div class="mt-5 flex">
                        <div class="w-full mr-4">
                            <InputLabel for="Nombre" value="Nombre" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="w-full  ml-4">
                            <InputLabel for="Apellido" value="Apellido" />

                            <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.lastName"
                                required autocomplete="lastName" />

                            <InputError class="mt-2" :message="form.errors.lastName" />
                        </div>
                    </div>







                    <div class="mt-4">
                        <InputLabel for="email" value="Correo electronico" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="mt-4">
                        <InputLabel for="password" value="Contraseña" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>






                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirmar contraseña" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>






                    <div class=" flex">
                        <div class="w-full mr-4">
                            <InputLabel for="provincia" value="Provincia" />

                            <select id="provincia"
                                class="mt-1 block w-full provincia border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm"
                                v-model="form.provincia" required>
                                <option value="" disabled selected>Seleccione una provincia</option>
                                <option value="Azúa">Azúa</option>
                                <option value="Baoruco">Baoruco</option>
                                <option value="Barahona">Barahona</option>
                                <option value="Dajabón">Dajabón</option>
                                <option value="Distrito Nacional">Distrito Nacional</option>
                                <option value="Duarte">Duarte</option>
                                <option value="Elías Piña">Elías Piña</option>
                                <option value="El Seibo">El Seibo</option>
                                <option value="Espaillat">Espaillat</option>
                                <option value="Hato Mayor">Hato Mayor</option>
                                <option value="Independencia">Independencia</option>
                                <option value="La Altagracia">La Altagracia</option>
                                <option value="La Romana">La Romana</option>
                                <option value="La Vega">La Vega</option>
                                <option value="María Trinidad Sánchez">María Trinidad Sánchez</option>
                                <option value="Monseñor Nouel">Monseñor Nouel</option>
                                <option value="Monte Cristi">Monte Cristi</option>
                                <option value="Monte Plata">Monte Plata</option>
                                <option value="Pedernales">Pedernales</option>
                                <option value="Peravia">Peravia</option>
                                <option value="Puerto Plata">Puerto Plata</option>
                                <option value="Salcedo">Salcedo</option>
                                <option value="Samaná">Samaná</option>
                                <option value="Sánchez Ramírez">Sánchez Ramírez</option>
                                <option value="San Cristobal">San Cristobal</option>
                                <option value="San José de Ocoa">San José de Ocoa</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Pedro de Macorís">San Pedro de Macorís</option>
                                <option value="Santiago de los Caballeros">Santiago de los Caballeros</option>
                                <option value="Santiago Rodríguez">Santiago Rodríguez</option>
                                <option value="Santo Domingo">Santo Domingo</option>
                                <option value="Valverde">Valverde</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.provincia" />
                        </div>

                        <div class="w-full ml-4">
                            <InputLabel for="telefono" value="Numero de telefono" />

                            <TextInput id="telefono" type="number" class="mt-1 block w-full" v-model="form.telefono"
                                required autocomplete="telefono" />

                            <InputError class="mt-2" :message="form.errors.telefono" />
                        </div>
                    </div>






                    <div class="">
                        <div class="w-full mr-2">
                            <InputLabel for="Cedula" value="Cédula de ciudadanía
" />

                            <TextInput id="Cedula" type="text" class="mt-1 block w-full" v-model="form.Cedula" required
                                autocomplete="Cedula" />

                            <InputError class="mt-2" :message="form.errors.Cedula" />
                        </div>

                    </div>






                    <div class="flex items-center justify-center mt-4">
                        <Link :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ¿Ya registrado?
                        </Link>

                        <PrimaryButton class="ms-4 w-100" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Registro
                        </PrimaryButton>
                    </div>


                </form>
            </div>
            <div v-else class="Organización">













                <form @submit.prevent="submit">

                    <div class="w-full mr-4">
                        <InputLabel for="Nombre" value="Nombre de la empresa" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autocomplete="name" autofocus />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>





                    <div class="mt-4">
                        <InputLabel for="emaile" value="Correo de la organizacion" />

                        <TextInput id="emaile" type="email" class="mt-1 block w-full" v-model="form.emaile" required
                            autocomplete="emaile" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class=" ">
                        <div class="w-full mr-2">
                            <InputLabel for="telefono" value="Número de teléfono" />

                            <TextInput id="telefono" type="number" class="mt-1 block w-full" v-model="form.telefono"
                                required autocomplete="telefono" />

                            <InputError class="mt-2" :message="form.errors.telefono" />
                        </div>

                    </div>


               



                    <div class="mt-4">
                        <InputLabel for="password" value="Contraseña" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>






                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirmar contraseña" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>







                    <div class="flex">
                        <div class="w-full mr-4">
                            <InputLabel for="pais" value="Pais" />

                            <TextInput id="pais" type="text" class="mt-1 block w-full" v-model="form.pais" required
                                autocomplete="pais" />

                            <InputError class="mt-2" :message="form.errors.pais" />
                        </div>


                        <div class="w-full  ml-4">
                            <InputLabel for="Sector" value="Sector" />

                            <TextInput id="Sector" type="text" class="mt-1 block w-full" v-model="form.Sector" required
                                autocomplete="Sector" />

                            <InputError class="mt-2" :message="form.errors.Sector" />
                        </div>
                    </div>











                    <div class="flex items-center justify-center mt-4">
                        <Link :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ¿Ya registrado?
                        </Link>

                        <PrimaryButton class="ms-4 w-100" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Registro
                        </PrimaryButton>
                    </div>


                </form>











            </div>

        </div>
    </div>
</template>

<style>
* {
    z-index: 1;
}

.provincia:focus {
    border-color: #ff5215;
    /* Color personalizado para el borde */
}

.provincia:focus {
    outline: none;
    /* Eliminar el outline predeterminado */
    box-shadow: 0 0 0 2px #ff5215;
    /* Simular anillo de enfoque con color personalizado */
}


.contenedor {

    overflow: hidden;
}

.fondo{
position: absolute;
width: 1200px;
top: 45%;
left: 20%;


}



.container {
    width: 40%;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.877);
    border-radius: 36px;
    margin: 0 auto;
    margin: 100px;

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
    justify-content: end;
    align-items: center;
}

.texto h1 {
    margin: 0;
    font-size: 32px;
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
