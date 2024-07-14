<script setup>

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel(reg).vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { Head, useForm } from '@inertiajs/vue3';
import Switch from '@/Components/Switch.vue';
import { ref, onMounted } from 'vue';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    type_user_id: 1,
    province_id: '',
    company_id: 0,
    company_name: 'Null',
});

const fondoColor = ref('#7D98F8');
const tituloColor = ref('#C8871F'); // Color inicial del título
const tipo = ref('estudiante');
const img = ref('/images/graduation.svg');

const submit = () => {
    form.post(route('register'), {
        // onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const onEstudiante = () => {
    tituloColor.value = '#F9A826';
    tipo.value = 'estudiante';
    fondoColor.value = '#7D98F8';
    img.value = '/images/graduation.svg';
    form.type_user_id = 1;

    console.log('tipo cambiado a estudiante' + form.type_user_id);

    form.reset( 'first_name' , 'last_name', 'email', 'password', 'password_confirmation' , 'province_id', );
};

const onOrganizacion = () => {
    tituloColor.value = '#4A5568';
    fondoColor.value = '#F9A826';
    tipo.value = 'Organización';
    img.value = '/images/production.svg';
    form.type_user_id = 2;

    console.log('tipo cambiado a Organización ' + form.type_user_id);
    form.reset('first_name', 'last_name', 'email', 'password', 'password_confirmation', 'province_id' );

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
                            <InputLabel for="first_name" value="Nombre" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.first_name"
                                required autofocus autocomplete="given-name" />

                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>


                        <div class="w-full  ml-4">
                            <InputLabel for="last_name" value="Apellido" />

                            <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.last_name"
                                required autocomplete="family-name" />

                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                    </div>







                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="mt-4">
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>




                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>






                    <div class=" flex mb-10">
                        <div class="w-full mr-4">
                            <InputLabel for="province_id" value="Provincia" />

                            <select id="province_id"
                                class="mt-1 block w-full provincia border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm"
                                v-model="form.province_id" required>
                                <option value="" disabled selected>Seleccione una provincia</option>
                                <option value="1">Santo Domingo</option>
                                <option value="2">San Cristobal</option>
                                <option value="3">Azúa</option>
                                <option value="4">Baoruco</option>
                                <option value="5">Barahona</option>
                                <option value="6">Dajabón</option>
                                <option value="7">Distrito Nacional</option>
                                <option value="8">Duarte</option>
                                <option value="9">Elías Piña</option>
                                <option value="10">El Seibo</option>
                                <option value="11">Espaillat</option>
                                <option value="12">Hato Mayor</option>
                                <option value="13">Independencia</option>
                                <option value="14">La Altagracia</option>
                                <option value="15">La Romana</option>
                                <option value="16">La Vega</option>
                                <option value="17">María Trinidad Sánchez</option>
                                <option value="18">Monseñor Nouel</option>
                                <option value="19">Monte Cristi</option>
                                <option value="20">Monte Plata</option>
                                <option value="21">Pedernales</option>
                                <option value="22">Peravia</option>
                                <option value="23">Puerto Plata</option>
                                <option value="24">Salcedo</option>
                                <option value="25">Samaná</option>
                                <option value="26">Sánchez Ramírez</option>
                                <option value="27">San José de Ocoa</option>
                                <option value="28">San Juan</option>
                                <option value="29">San Pedro de Macorís</option>
                                <option value="30">Santiago de los Caballeros</option>
                                <option value="31">Santiago Rodríguez</option>
                                <option value="32">Valverde</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.province_id" />
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
                    <div class="mt-5 flex">
                        <div class="w-full mr-4">
                            <InputLabel for="first_name" value="Nombre(Propietario)" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.first_name"
                                required autofocus autocomplete="given-name" />

                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>


                        <div class="w-full  ml-4">
                            <InputLabel for="last_name" value="Apellido(Propietario)" />

                            <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.last_name"
                                required autocomplete="family-name" />

                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                    </div>







                    <div class="mt-4">
                        <InputLabel for="email" value="Email Organizacional" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div class="mt-4">
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>




                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>






                    <div class=" flex mb-10">
                        <div class="w-full mr-4">
                            <InputLabel for="province_id" value="Provincia" />

                            <select id="province_id"
                                class="mt-1 block w-full provincia border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm"
                                v-model="form.province_id" required>
                                <option value="" disabled selected>Seleccione una provincia</option>
                                <option value="1">Santo Domingo</option>
                                <option value="2">San Cristobal</option>
                                <option value="3">Azúa</option>
                                <option value="4">Baoruco</option>
                                <option value="5">Barahona</option>
                                <option value="6">Dajabón</option>
                                <option value="7">Distrito Nacional</option>
                                <option value="8">Duarte</option>
                                <option value="9">Elías Piña</option>
                                <option value="10">El Seibo</option>
                                <option value="11">Espaillat</option>
                                <option value="12">Hato Mayor</option>
                                <option value="13">Independencia</option>
                                <option value="14">La Altagracia</option>
                                <option value="15">La Romana</option>
                                <option value="16">La Vega</option>
                                <option value="17">María Trinidad Sánchez</option>
                                <option value="18">Monseñor Nouel</option>
                                <option value="19">Monte Cristi</option>
                                <option value="20">Monte Plata</option>
                                <option value="21">Pedernales</option>
                                <option value="22">Peravia</option>
                                <option value="23">Puerto Plata</option>
                                <option value="24">Salcedo</option>
                                <option value="25">Samaná</option>
                                <option value="26">Sánchez Ramírez</option>
                                <option value="27">San José de Ocoa</option>
                                <option value="28">San Juan</option>
                                <option value="29">San Pedro de Macorís</option>
                                <option value="30">Santiago de los Caballeros</option>
                                <option value="31">Santiago Rodríguez</option>
                                <option value="32">Valverde</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.province_id" />
                        </div>


                    </div>



                    <div class="mt-4">
                        <InputLabel for="company_name" value="Nombre de la organización" />
                        <TextInput id="company_name" type="text" class="mt-1 block w-full" v-model="form.company_name"
                            required />
                        <InputError class="mt-2" :message="form.errors.company_name" />
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

.fondo {
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
