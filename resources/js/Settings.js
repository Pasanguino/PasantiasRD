// Settings.js

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
        slideIn: false
      };
    },
    mounted() {
      // Mostrar la animación del sidebar
      setTimeout(() => {
        this.slideIn = true;
      }, 100);
      this.toggleReturnText();
    },
    methods: {
      deactivateAccount() {
        this.showDeactivateModal = false;
        this.showSuccess('Se ha enviado un mensaje a su correo correspondiente para confirmar la deshabilitación.');
      },
      confirmDeleteAccount() {
        this.showDeactivateModal = false;
        this.showConfirmDeleteModal = true;
      },
      sendDeleteConfirmation() {
        this.showConfirmDeleteModal = false;
        this.showSuccess('Se ha enviado un correo para confirmar la eliminación de la cuenta.');
      },
      changeUsername() {
        this.showChangeUsernameModal = false;
        this.showSuccess('Nombre de usuario cambiado exitosamente.');
      },
      changePassword() {
        this.showChangePasswordModal = false;
        this.showSuccess('Contraseña cambiada exitosamente.');
      },
      addRecoveryEmail() {
        if (this.validateEmail(this.newRecoveryEmail)) {
          this.showAddRecoveryEmailModal = false;
          this.showSuccess('Correo de recuperación añadido. Se ha enviado un correo de confirmación.');
        } else {
          alert("Por favor, introduce un correo electrónico válido.");
        }
      },
      changeRecoveryEmail() {
        if (this.validateEmail(this.currentRecoveryEmail) && this.validateEmail(this.newRecoveryEmail)) {
          this.showChangeRecoveryEmailModal = false;
          this.showSuccess('Correo de recuperación cambiado. Verifique su bandeja de entrada para confirmar.');
        } else {
          alert("Por favor, introduce correos electrónicos válidos.");
        }
      },
      toggleTheme() {
        if (this.isDarkMode) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
      },
      showSuccess(message) {
        this.successMessage = message;
        this.showSuccessMessage = true;
        setTimeout(() => {
          this.showSuccessMessage = false;
        }, 3000);
      },
      scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      },
      toggleReturnText() {
        window.addEventListener('scroll', () => {
          this.showReturnText = window.scrollY > 200;
        });
      },
      validateEmail(email) {
        const re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        return re.test(email);
      }
    }
  };
  