// Home.js

export default {
  mounted() {
    // Agrega la clase 'slide-in' después de que la página se haya cargado
    const navContainer = document.querySelector(".nav-container");
    navContainer.classList.add("slide-in");

    // Espera a que se renderice el elemento antes de agregar las clases de animación al logo y los enlaces de autenticación
    this.$nextTick(() => {
      const logo = document.querySelector(".logo");
      const authLinks = document.querySelector(".auth-links");
      logo.classList.add("slide-in-left");
      authLinks.classList.add("slide-in-right");
    });
  }
};
