import axios from 'axios';

export default {
  data() {
    return {
      description: 'Añade una descripcion',
      identification_path: '000-0000000-0',
      email: 'claro@claro.com',
      phone: '809-000-0000',
      showSuccessMessage: false,
      showReturnText: false,
      slideIn: false,
      successMessage: '',
      userLogoUrl: '/images/profile-user.png', // Ruta inicial del logo por defecto del usuario
      cvFileName: null,
      cvFile: null,
      logoFile: null
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
      const formData = new FormData();
      formData.append('aboutUs', this.aboutUs);
      formData.append('location', this.location);
      formData.append('email', this.email);
      formData.append('phone', this.phone);

      if (this.logoFile) {
        formData.append('logoFile', this.logoFile);
      }

      if (this.cvFile) {
        formData.append('cvFile', this.cvFile);
      }

      axios.put(`/profile/${this.$route.params.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          this.showSuccess('Cambios guardados exitosamente.');
        })
        .catch(error => {
          console.error('Error al guardar los cambios:', error);
        });
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
    // Métodos para el logo
    onLogoFileDrop(event) {
      const file = event.dataTransfer.files[0];
      this.uploadLogo(file);
    },
    onLogoFileChange(event) {
      const file = event.target.files[0];
      this.uploadLogo(file);
    },
    uploadLogo(file) {
      if (file && file.type.startsWith('image/')) {
        this.logoFile = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.userLogoUrl = e.target.result;
          this.showSuccess('Logo actualizado exitosamente.');
        };
        reader.readAsDataURL(file);
      } else {
        this.showSuccess('Por favor, selecciona una imagen válida para el logo.');
      }
    },
    triggerLogoFileInput() {
      this.$refs.logoFileInput.click();
    },

    // Métodos para el CV
    onCvFileDrop(event) {
      const file = event.dataTransfer.files[0];
      this.uploadCv(file);
    },
    onCvFileChange(event) {
      const file = event.target.files[0];
      this.uploadCv(file);
    },
    uploadCv(file) {
      if (file && (file.name.endsWith('.pdf') || file.name.endsWith('.doc') || file.name.endsWith('.docx'))) {
        this.cvFile = file;
        this.cvFileName = file.name;
        this.showSuccess('CV actualizado exitosamente.');
      } else {
        this.showSuccess('Por favor, selecciona un archivo PDF o Word válido para el CV.');
      }
    },
    triggerCvFileInput() {
      this.$refs.cvFileInput.click();
    }
  }
};
