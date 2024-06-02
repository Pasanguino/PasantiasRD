<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Registro" />

        <div class="flex justify-center items-center ">
            <div>
                <SecondaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Estudiante
                </SecondaryButton>
                <SecondaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Empresa
                </SecondaryButton>
            </div>
        </div>


        <form @submit.prevent="submit">
            <!--nombre y apellido -->
            <div class="flex flex-row items-center">
                <div class="mr-4">
                    <InputLabel for="Nombre" value="Nombre" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-4">
                    <InputLabel for="Apellido" value="Apellido" />

                    <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.lastName" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.lastName" />
                </div>
            </div>
            <!--edad y genero -->
            <div class="flex flex-row items-center">
                <div class="mr-4">
                    <InputLabel for="Nombre" value="Fecha de nacimiento" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.age" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-4">
                    <InputLabel for="Genero" value="Genero" />

                    <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.gender" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>
            </div>

            <!--Correo electronico -->

            <div class="mr-4">
                <InputLabel for="email" value="Correo electronico" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!--Contraseña y confirmacion-->
            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="confirmar Contraseña" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <!--Institucion educativa y carrera-->

            <div class="flex flex-row items-center">
                <div class="mr-4">
                    <InputLabel for="Nombre" value="Institucion educativa" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-4">
                    <InputLabel for="Apellido" value="Carrera" />

                    <TextInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.lastName" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.lastName" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ¿Ya registrado?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registro
                </PrimaryButton>
            </div>


        </form>
    </GuestLayout>
</template>

<style>

</style>
