import axios from "axios";

// Obtener el token CSRF del meta tag
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

// Configurar Axios para incluir el token CSRF en todas las solicitudes
axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;

// Importa otras configuraciones o bibliotecas necesarias
