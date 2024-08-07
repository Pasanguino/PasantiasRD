<script setup>
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel(reg).vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Switch from "@/Components/Switch.vue";
import { ref, onMounted } from "vue";
import Swal from 'sweetalert2';

const form = useForm({
  first_name: "",
  last_name: "",
  email: "",
  password: "",
  password_confirmation: "",
  type_user_id: 1,
  province_id: "",
  company_id: 0,
  company_name: "Null",
});

const companies = ref([]);
const fondoColor = ref("#7D98F8");
const tituloColor = ref("#C8871F"); // Color inicial del título
const tipo = ref("estudiante");
const img = ref("/images/graduation.svg");

const submit = () => {
  form.post(route("register"), {
    // onFinish: () => form.reset('password', 'password_confirmation'),
  });
};

const onEstudiante = () => {
  tituloColor.value = "#F9A826";
  tipo.value = "estudiante";
  fondoColor.value = "#7D98F8";
  img.value = "/images/graduation.svg";
  form.type_user_id = 1;

  console.log("tipo cambiado a estudiante" + form.type_user_id);

  form.reset(
    "first_name",
    "last_name",
    "email",
    "password",
    "password_confirmation",
    "province_id"
  );
};

const onOrganizacion = () => {
  tituloColor.value = "#4A5568";
  fondoColor.value = "#F9A826";
  tipo.value = "Organización";
  img.value = "/images/production.svg";
  form.type_user_id = 2;

  console.log("tipo cambiado a Organización " + form.type_user_id);
  form.reset(
    "first_name",
    "last_name",
    "email",
    "password",
    "password_confirmation",
    "province_id"
  );
};

const fetchProvinces = async () => {
  try {
    const response = await axios.get('/province');
    return response.data;
  } catch (error) {
    console.error('Error fetching provinces:', error);
    return [];
  }
};

const showAlert = async () => {
  const provinces = await fetchProvinces();

  const { value: formValues } = await Swal.fire({
    title: 'Crear Compañía',
    html:
      `<div class="flex flex-col items-center space-y-4">
        <input id="swal-input1" class="swal2-input px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la compañía">
        <select id="swal-input2" class="swal2-input px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          ${provinces.map(province => `<option value="${province.id}">${province.province_name}</option>`).join('')}
        </select>
        <input id="swal-input3" type="password" class="swal2-input px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contraseña de confirmación">
      </div>`,
    focusConfirm: false,
    confirmButtonText: 'Crear Compañía',
    confirmButtonColor: '#4F46E5', // Tailwind indigo-600
    cancelButtonColor: '#F43F5E', // Tailwind rose-600
    cancelButtonText: 'Cancelar',
    showCancelButton: true,
    preConfirm: () => {
      return [
        document.getElementById('swal-input1').value,
        document.getElementById('swal-input2').value,
        document.getElementById('swal-input3').value
      ];
    },
    customClass: {
      container: 'p-4 rounded-lg border border-gray-200 shadow-lg bg-white',
      title: 'text-lg font-semibold text-gray-900',
      input: 'py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500',
      confirmButton: 'bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500',
      cancelButton: 'bg-rose-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500'
    }
  });

  if (formValues) {
    const [companyName, provinceId, confirmationPassword] = formValues;
    await createCompany(companyName, provinceId, confirmationPassword);
  }
};


const createCompany = async (companyName, provinceId, confirmationPassword) => {
  try {
    const response = await axios.post('/companies', {
      company_name: companyName,
      province_id: provinceId,
      confirmation_password: confirmationPassword
    });
    Swal.fire('Éxito', response.data.message, 'success');
    
    // Actualiza los campos del formulario
    form.company_id = response.data.company.id;
    form.company_name = response.data.company.company_name;

    // Vuelve a obtener las compañías actualizadas
    await fetchCompanies();

  } catch (error) {
    if (error.response && error.response.status === 401) {
      Swal.fire('Error', 'Contraseña de confirmación incorrecta', 'error');
    } else {
      Swal.fire('Error', 'Hubo un problema al crear la compañía', 'error');
    }
    console.error('Error creating company:', error);
  }
};

const fetchCompanies = async () => {
  try {
    const response = await axios.get('/companies');
    companies.value = response.data;
    console.log(companies.value);
  } catch (error) {
    console.error("Error loading companies:", error);
  }
};

onMounted(() => {
  document.documentElement.style.setProperty("--titulo-color", tituloColor.value);
  fetchCompanies();
});
</script>



<template>
  <Head title="Registro" />

  <div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 contenedor"
    :style="{ backgroundColor: fondoColor }"
  >
    <img :src="img" alt="" class="fondo" />
    <div class="container">
      <div
        class="titulo"
        style="display: grid; grid-template-columns: repeat(12, 1fr); align-items: center"
      >
        <div class="texto" style="grid-column: span 10">
          <h1 :style="{ color: tituloColor, margin: 0 }">Registro de {{ tipo }}</h1>
        </div>
        <div class="switch" style="grid-column: span 2; justify-self: end">
          <Switch :onEstudiante="onEstudiante" :onOrganizacion="onOrganizacion" />
        </div>
      </div>

      <div v-if="tipo === 'estudiante'" class="Estudiante">
        <form @submit.prevent="submit">
          <div class="mt-5 flex">
            <div class="w-full mr-4">
              <InputLabel for="first_name" value="Nombre" />

              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.first_name"
                required
                autofocus
                autocomplete="given-name"
              />

              <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="w-full ml-4">
              <InputLabel for="last_name" value="Apellido" />

              <TextInput
                id="lastName"
                type="text"
                class="mt-1 block w-full"
                v-model="form.last_name"
                required
                autocomplete="family-name"
              />

              <InputError class="mt-2" :message="form.errors.last_name" />
            </div>
          </div>

          <div class="mt-4">
            <InputLabel for="email" value="Email" />

            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Contraseña" />
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
            <TextInput
              id="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password_confirmation"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password_confirmation" />
          </div>

          <div class="flex mb-10">
            <div class="w-full mr-4">
              <InputLabel for="province_id" value="Provincia" />

              <select
                id="province_id"
                class="mt-1 block w-full provincia border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm"
                v-model="form.province_id"
                required
              >
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
            <Link
              :href="route('login')"
              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              ¿Ya registrado?
            </Link>

            <PrimaryButton
              class="ms-4 w-100"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
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

              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.first_name"
                required
                autofocus
                autocomplete="given-name"
              />

              <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="w-full ml-4">
              <InputLabel for="last_name" value="Apellido(Propietario)" />

              <TextInput
                id="lastName"
                type="text"
                class="mt-1 block w-full"
                v-model="form.last_name"
                required
                autocomplete="family-name"
              />

              <InputError class="mt-2" :message="form.errors.last_name" />
            </div>
          </div>

          <div class="mt-4">
            <InputLabel for="email" value="Email Organizacional" />

            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Contraseña" />
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
            <TextInput
              id="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password_confirmation"
              required
              autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password_confirmation" />
          </div>

          <div class="flex mb-10">
            <div class="w-full mr-4">
              <InputLabel for="province_id" value="Provincia" />

              <select
                id="province_id"
                class="mt-1 block w-full provincia border-gray-300 custom-focus-border custom-focus-ring rounded-md shadow-sm"
                v-model="form.province_id"
                required
              >
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

          <!-- companies  ------------------------------------ -->
          <div class="mt-4">
            <div class="w-full"></div>
          </div>

          <div class="mt-5 flex">
            <div class="w-full mr-4">
              <InputLabel for="company_id" value="Nombre de la organización" />
              <select
                id="company_id"
                v-model="form.company_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required
              >
                <option value="" disabled>Seleccione una organización</option>
                <option
                  v-for="company in companies"
                  :key="company.id"
                  :value="company.id"
                  class="text-gray-900"
                >
                  {{ company.company_name }}
                </option>
              </select>
              <InputError class="mt-2" :message="form.errors.company_id" />
            </div>
            <div class="ml-auto ite flex items-end p-1">
<button
  class="w-12 h-12 flex items-center justify-center bg-orange-500 text-white rounded-full shadow-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 transition duration-300 ease-in-out"
  @click="showAlert"
>
  <!-- Usando el ícono de Heroicons para el símbolo de "+" -->
  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
  </svg>
</button>
            </div>
          </div>

          <div class="flex items-center justify-center mt-4">
            <Link
              :href="route('login')"
              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              ¿Ya registrado?
            </Link>

            <PrimaryButton
              class="ms-4 w-100"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
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

.as {
  display: flex;
  justify-content: center;
  align-items: center;
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