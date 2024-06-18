<template>
  <div class="/">
    <header class="header">
      <div class="logo">
        <img src="/images/logo.png" alt="Logo" />
        <span>Pasangüino</span>
      </div>
      <div class="background-container">
        <img src="/images/background_home.png" alt="Background" class="background_image" />
      </div>
      <nav class="nav-container">
        <ul class="nav-links">
          <li><a href="/">Home</a></li>
          <li><a href="#">Encuentra Pasantías</a></li>
          <li><a href="#">Soporte Técnico</a></li>
        </ul>
      </nav>
      <div class="auth-links">
        <a href="login" class="login">Inicia sesión</a>
        <a href="register" class="register">Regístrate</a>
      </div>
    </header>
    <main>
      <section class="intro">
        <div class="intro-content">
          <h1><b>La Mejor Forma de Aplicar</b></h1>
          <h2><b><span>Rápidamente</span> a Pasantías</b></h2>
          <p>Cada mes tienes la oportunidad de<br>encontrar nuevas vacantes en tu área<br>de estudio.</p>
          <div class="search-bar-container">
            <div class="search-bar">
              <div class="search-input">
                <input type="text" placeholder="Localización" />
              </div>
              <div class="search-input">
                <input type="text" placeholder="Puesto" />
              </div>
              <button>
                <span class="search-icon">🔍</span> Buscar
              </button>
            </div>
          </div>
        </div>
      </section>
      <div class="flex flex-col min-h-screen">
        
  <!-- Contenido principal aquí -->
    <body class="vacantes-por-localización"> 
      <div class="contenedor-sección">
      <div class="encabezado">
        <br><h2 class="Título-sección-provincias">Vacantes por localización</h2>
        <br>
        <p class="Bienvenida-sección-provincias">Encuentra vacantes en tu provincia para mejor movilidad</p>
        <br><br>
      </div> 
        <table class="tabla-provincias">
            <tr>
            <td>
                <img src="https://www.colonialtours.com/images/sdqmod03.jpg" alt="Santo Domingo">
                <h2>Santo Domingo</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
            </td>
            <td>
                <img src="https://situr.mitur.gob.do/wp-content/uploads/2022/03/Malecon-Santo-Domingo-1536x1024-1.jpg" alt="Distrito Nacional">
                <br>
                <h2>Distrito Nacional</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
            </td>
            <td>
                <img src="https://scontent.fhex5-1.fna.fbcdn.net/v/t1.6435-9/65041941_2113602218937254_7655708110526349312_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFoYP34ApV7b49Etrb7uxHiMXN57cmLgb4xc3ntyYuBvjQdSf8-NHUyi9Mlz5ZVdrMFEaGyqiX4aadJkzJHXqRC&_nc_ohc=O-vhdDBp7ScQ7kNvgEXNBlp&_nc_ht=scontent.fhex5-1.fna&oh=00_AYBaXujXKlN0HLmSjnnF3-n4eyF9vZWCTCNhlno9456ctQ&oe=6696FDA5" alt="El Seibo">
                <br>
                <h2>El Seibo</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
            </td>               
            </tr>
            <tr>
            <td>
                <img src="https://resources.diariolibre.com/images/binrepository/turistas-en-la-basilica_16961603_20210803165043-focus-0-0-375-240.jpg" alt="La Altagracia">
                <br>
                <h2>La Altagracia</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
                
            </td>
            <td>
                <img src="https://lh3.googleusercontent.com/p/AF1QipNe8WYw6F4aAkjzw4WTxyWMWgtFQ2GC2PNPqAqS=s1360-w1360-h1020" alt="San Pedro de Macorís">
                <br>
                <h2>San Pedro de Macorís</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
            </td>
            <td>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIYJ9Jmq6YK86QURR_6bYdqYoezd84Jw6L8Q&s" alt="Hato Mayor">
                <br>
                <h2>Hato Mayor</h2>
                <pre><p>Vacantes: 0  Empresas: 0</p></pre>
            </td>         
            </tr>
        </table>
        <br>
        <button id="verTodasBtn">Ver todas <span id="arrow">&#9660;</span></button>
      </div>  
    </body> 
  
  <!-- Footer ajustado sin posición absoluta -->
  <footer class="text-white py-2 text-xs">
    <div class="container mx-auto flex flex-wrap justify-between">
      <!-- Contenido del footer -->
      <div class="w-full sm:w-1/3 px-4 mb-4 sm:mb-0 p-2">
        <div class="flex items-center mb-2">
          <h1 class="text-xl font-bold">Pasangüino</h1>
        </div>
        
        <p>Mejoramos y facilitamos cada día la búsqueda y aplicación a pasantías en toda la República Dominicana.</p>
      </div>
      <div class="w-full sm:w-1/6 px-4 mb-4 sm:mb-0">
        <h2 class="text-lg font-semibold mb-2">Información</h2>
        <ul>
          <li class="mb-1"><a href="/about-us" class="hover:underline">Sobre nosotros</a></li>
          <li class="mb-1"><a href="/contact-us" class="hover:underline">Contáctanos</a></li>
        </ul>
      </div>
      <div class="w-full sm:w-1/6 px-4">
        <h2 class="text-lg font-semibold mb-2">Más</h2>
        <ul>
          <li class="mb-1"><a href="/privacy" class="hover:underline">Privacidad</a></li>
          <li class="mb-1"><a href="/terms" class="hover:underline">Términos y condiciones</a></li>
          <li class="mb-1"><a href="/help" class="hover:underline">Ayuda</a></li>
          <li class="mb-1"><a href="/faq" class="hover:underline">FAQ</a></li>
        </ul>
      </div>
    </div>
    <hr class="border-t border-white/50 my-2">
    <div class="text-center mt-2 text-white/70">
      &copy; 2024 Pasangüino. Todos los derechos reservados.
    </div>
  </footer>
</div>
    </main>
  </div>
</template>

<script>
import HomeScript from '/resources/js/Home.js';

export default {
  name: 'Home',
  mounted() {
    HomeScript.mounted.call(this); // Llama al método mounted de Home.js y pasa el contexto de Vue
  }
};
</script>

<style scoped src="/resources/css/Home.css"></style>
