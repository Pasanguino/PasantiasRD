<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>

    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Panel de usuario
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Acceso
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Registro
                            </Link>
                        </template>
                    </nav>
                </header>

                <div class="vacantes-por-localización">
                    <section>
                    <h1 class="Título-sección-provincias">Vacantes por localización</h1>
                    <p class="Bienvenida-sección-provincias">Encuentra vacantes en tu provincia para mejor movilidad</p>
                    <div class="sección provincias">
                    <table class="tabla-provincias">
                        <tr>
                        <td>
                            <img src="resources\assets\Santo Domingo.png" alt="Santo Domingo">
                            <p>Santo Domingo</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                        </td>
                        <td>
                            <img src="resources\assets\Distrito nacional.png" alt="Distrito Nacional">
                            <p>Distrito Nacional</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                        </td>
                        <td>
                            <img src="resources\assets\El Seibo.png" alt="El Seibo">
                            <p>El Seibo</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                        </td>               
                        </tr>
                        <tr>
                        <td>
                            <img src="resources\assets\La Altagracia.jpg" alt="La Altagracia">
                            <p>La Altagracia</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                            
                        </td>
                        <td>
                            <img src="resources\assets\San Pedro de Macorís.png" alt="San Pedro de Macorís">
                            <p>San Pedro de Macorís</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                        </td>
                        <td>
                            <img src="resources\assets\Hato Mayor.png" alt="Hato Mayor">
                            <p>Hato Mayor</p>
                            <p>Vacantes: 0</p>&nbsp<p>Empresas: 0</p>
                        </td>         
                        </tr>
                    </table>
                    </div>
                    </section>
                </div>
                <style scoped src="/resources/css/Homedos.css"></style>

                <footer class="bg-orange-500 text-white py-16">
                    <div class="container mx-auto flex flex-wrap justify-around">
                        <div class="w-full sm:w-1/3 px-4 mb-8 sm:mb-0">
                            <div class="flex items-center mb-4">
                                <h1 class="text-2xl font-bold">Pasangüino</h1>
                            </div>
                            <p>Mejoramos y facilitamos cada día la búsqueda y aplicación a pasantías en toda la
                                República Dominicana.</p>
                        </div>
                        <div class="w-full sm:w-1/6 px-4 mb-8 sm:mb-0">
                            <h2 class="text-xl font-semibold mb-4">Recursos</h2>
                            <ul>
                                <li class="mb-2"><a href="#" class="hover:underline">Sobre nosotros</a></li>
                                <li class="mb-2"><a href="#" class="hover:underline">Contáctanos</a></li>
                            </ul>
                        </div>
                        <div class="w-full sm:w-1/6 px-4">
                            <h2 class="text-xl font-semibold mb-4">Más</h2>
                            <ul>
                                <li class="mb-2"><a href="#" class="hover:underline">Privacidad</a></li>
                                <li class="mb-2"><a href="#" class="hover:underline">Términos y condiciones</a></li>
                                <li class="mb-2"><a href="#" class="hover:underline">Ayuda</a></li>
                                <li class="mb-2"><a href="#" class="hover:underline">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="border-t border-white/50 my-8">
                    <div class="text-center mt-8 text-white/70 text-sm">
                       Copyright &copy; 2024. Pasangüino all rights reserved
                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>
