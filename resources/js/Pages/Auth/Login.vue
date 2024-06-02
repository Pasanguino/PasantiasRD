<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div class="login-page">

        <div class="container">
            <div class="logo">
                <div class="item">
                    <img src="logo.jpg" alt="">
                    <div class="marca">
                        <h1>pasangüino </h1>
                    </div>
                </div>
            </div>
            <div class="login">
                <div class="container">






                    <div class="form">
                        <h1>Inicio de sección </h1>
                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                    required autofocus autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Contraseña" />

                                <TextInput id="password" type="password" class="mt-1 block w-full"
                                    v-model="form.password" required autocomplete="current-password" />

                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                    <span class="ms-2 text-sm text-gray-600">Recordar contraseña</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link v-if="canResetPassword" :href="route('password.request')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                ¿Olvidaste tu contraseña?
                                </Link>

                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Iniciar sección
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




















    </div>

</template>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.login-page {
    background: rgb(89, 44, 3);
    background: linear-gradient(0deg, rgba(89, 44, 3, 1) 0%, rgba(191, 95, 7, 1) 100%);
    height: 100vh; 
    /* display: flex;
    justify-content: center;
    align-items: center; */
    /* padding: 60px 0px 60px 0px; */
    
}

.container {
    width: 60%;
    height: 600px;
    display: flex;
    border-radius: 20px;
    overflow: hidden;
    margin: auto;
    position: relative;
    top: 50px;

}

.container>div {
    flex: 1;
    text-align: center;
}

/* Media query para ocultar el primer div cuando el contenedor es pequeño */
@media only screen and (max-width: 1000px) {
    .container .logo {
        display: none;
    }
}

.logo {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.43);
    width: 100%;
}

.logo .item {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 50%;
}

.logo .item img {
    width: 100%;
}

.logo .item h1 {
    font-size: 50px;
    margin: 10px;
}

.login {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    width: 100%;
    /* Asegura que el ancho sea 100% */
    box-sizing: border-box;
    /* Asegura que el padding no afecte el tamaño total */
}

.login .container {
    width: 100%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    position: relative;
    top: -10px;
}



.login .container .titulo {
    text-align: center;
    margin: 40px;
    height: 20px;
}

.login .container .form h1 {
    font-size: 40px;
    font-weight: 900;
    padding: 20px;
    text-align: center;
    color: rgba(191, 95, 7, 1) ;

}

.login .container .form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
</style>
