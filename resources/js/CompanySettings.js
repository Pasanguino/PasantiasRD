// Archivo: resources/js/CompanySettings.js

export default {
    data() {
      return {
        showDeactivateModal: false,
        showConfirmDeleteModal: false,
        showChangeUsernameModal: false,
        showChangePasswordModal: false,
        showAddRecoveryEmailModal: false,
        showChangeRecoveryEmailModal: false,
        showSuccessMessage: false,
        showReturnText: false,
        isDarkMode: false,
        newUsername: '',
        currentPassword: '',
        newPassword: '',
        confirmPassword: '',
        newRecoveryEmail: '',
        currentRecoveryEmail: '',
        successMessage: '',
        slideIn: false,
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
      // Desactivar cuenta
      deactivateAccount() {
        this.showDeactivateModal = false;
        this.showSuccess('Se ha enviado un mensaje a su correo correspondiente para confirmar la deshabilitación.');
      },
      // Confirmar eliminación de cuenta
      confirmDeleteAccount() {
        this.showDeactivateModal = false;
        this.showConfirmDeleteModal = true;
      },
      // Enviar confirmación de eliminación
      sendDeleteConfirmation() {
        this.showConfirmDeleteModal = false;
        this.showSuccess('Se ha enviado un correo para confirmar la eliminación de la cuenta.');
      },
      // Cambiar nombre de usuario
      changeUsername() {
        this.showChangeUsernameModal = false;
        this.showSuccess('Nombre de usuario cambiado exitosamente.');
      },
      // Cambiar contraseña
      changePassword() {
        this.showChangePasswordModal = false;
        this.showSuccess('Contraseña cambiada exitosamente.');
      },
      // Añadir correo de recuperación
      addRecoveryEmail() {
        if (this.validateEmail(this.newRecoveryEmail)) {
          this.showAddRecoveryEmailModal = false;
          this.showSuccess('Correo de recuperación añadido. Se ha enviado un correo de confirmación.');
        } else {
          alert("Por favor, introduce un correo electrónico válido.");
        }
      },
      // Cambiar correo de recuperación
      changeRecoveryEmail() {
        if (this.validateEmail(this.currentRecoveryEmail) && this.validateEmail(this.newRecoveryEmail)) {
          this.showChangeRecoveryEmailModal = false;
          this.showSuccess('Correo de recuperación cambiado. Verifique su bandeja de entrada para confirmar.');
        } else {
          alert("Por favor, introduce correos electrónicos válidos.");
        }
      },
      // Cambiar tema
      toggleTheme() {
        if (this.isDarkMode) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
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
      },
      // Validar correo electrónico
      validateEmail(email) {
        const re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        return re.test(email);
      }
    }
  };
  