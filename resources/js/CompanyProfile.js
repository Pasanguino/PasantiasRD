// Archivo: CompanyProfile.js

export default {
    data() {
      return {
        aboutUs: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, mollitia quae tempore veritatis quidem blanditiis vero saepe ad dolores non illo hic fugiat nobis atque ipsa ipsum iste ullam eaque.',
        location: 'Santo Domingo\n, Distrito Nacional',
        email: 'claro@claro.com',
        phone: '809-000-0000',
        showSuccessMessage: false,
        showReturnText: false,
        slideIn: false,
        successMessage: '',
        userLogoUrl: '/images/profile-user.png' // Ruta inicial del logo por defecto del usuario
      };
    },
    mounted() {
      // Animación de deslizamiento del sidebar
      setTimeout(() => {
        this.slideIn = true;
      }, 100);
      this.toggleReturnText();
    },
    methods: {
      // Guardar cambios en la configuración
      saveChanges() {
        console.log('Changes saved:', {
          aboutUs: this.aboutUs,
          location: this.location,
          email: this.email,
          phone: this.phone
        });
        this.showSuccess('Cambios guardados exitosamente.');
      },
      // Mostrar mensaje de éxito
      showSuccess(message) {
        this.successMessage = message;
        this.showSuccessMessage = true;
        setTimeout(() => {
          this.showSuccessMessage = false;
        }, 3000);
      },
      // Desplazarse hacia arriba
      scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      },
      // Mostrar texto de retorno al desplazarse hacia abajo
      toggleReturnText() {
        window.addEventListener('scroll', () => {
          this.showReturnText = window.scrollY > 200;
        });
      },
      // Manejar soltar archivo
      onFileDrop(event) {
        const file = event.dataTransfer.files[0];
        this.uploadLogo(file);
      },
      // Manejar cambio de archivo
      onFileChange(event) {
        const file = event.target.files[0];
        this.uploadLogo(file);
      },
      // Cargar logo del usuario
      uploadLogo(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.userLogoUrl = e.target.result;
          this.showSuccess('Logo actualizado exitosamente.');
        };
        reader.readAsDataURL(file);
      },
      // Activar input de archivo
      triggerFileInput() {
        this.$refs.fileInput.click();
      }
    }
  };
  