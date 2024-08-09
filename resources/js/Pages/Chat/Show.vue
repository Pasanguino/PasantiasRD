<template>
  <div class="flex h-screen">
    <!-- Chats List Sidebar -->
    <div class="w-64 bg-gray-100 border-r border-gray-300 p-4 flex flex-col h-screen">
      <div class="flex-grow">
        <h2 class="text-lg font-semibold mb-4">Chats</h2>
        <ul>
          <li v-for="chat in chats" :key="chat.id" class="mb-2">
            <a
              :href="`/chats/${chat.id}`"
              class="block p-3 rounded-lg bg-gray-200 hover:bg-gray-300 transition"
            >
              {{ chat.user1.first_name }} & {{ chat.user2.first_name }}
            </a>
          </li>
        </ul>
      </div>
      <div class="mt-4">
        <a
          href="/"
          class="flex items-center justify-center w-full p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition"
        >
          <svg
            fill="white"
            class="w-5 h-5 mr-2"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
              d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"
            />
          </svg>
          Salir
        </a>
      </div>
    </div>

    <!-- Main Chat Area -->
    <div
      class="flex-1 flex flex-col bg-gray-50 border border-gray-200 rounded-lg shadow-lg"
    >
      <!-- Header -->
      <div class="flex-none bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-2xl font-semibold">{{ chatUser }}</h1>
      </div>

      <!-- Messages Area -->
      <div class="flex-1 p-4 overflow-y-auto bg-gray-100" ref="messagesContainer">
        <div v-for="mensaje in mensajes" :key="mensaje.id" class="mb-4 flex">
          <div
            :class="{
              'ml-auto': mensaje.user_id === userId,
              'mr-auto': mensaje.user_id !== userId,
            }"
          >
            <div
              :class="{
                'bg-blue-500 text-white': mensaje.user_id === userId,
                'bg-gray-200 text-gray-800': mensaje.user_id !== userId,
              }"
              class="inline-block px-4 py-3 rounded-lg shadow-lg max-w-md"
            >
              <p class="font-semibold mb-1">
                {{ mensaje.user.first_name }} {{ mensaje.user.last_name }}
              </p>
              <p>{{ mensaje.mensaje }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Message Input Area -->
      <div class="flex-none p-4 bg-gray-200 border-t flex items-center">
        <input
          v-model="nuevoMensaje"
          @keydown.enter="enviarMensaje"
          type="text"
          placeholder="Escribe un mensaje..."
          class="flex-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2"
        />
        <button
          @click="enviarMensaje"
          class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2"
        >
          Enviar
        </button>
        <button
          v-if="mostrarVideollamada"
          @click="hacerVideollamada"
          class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center"
        >
          <svg
            fill="white"
            class="w-6 h-6 mr-2"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
          >
            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
              d="M0 128C0 92.7 28.7 64 64 64l256 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2l0 256c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1l0-17.1 0-128 0-17.1 14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"
            />
          </svg>
          Videollamada
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    chat: Object,
    userId: Number,
  },
  data() {
    return {
      mensajes: [],
      nuevoMensaje: "",
      chats: [], // Lista de chats
      mostrarVideollamada: false,
    };
  },
  computed: {
    chatUser() {
      if (!this.chat.user1 || !this.chat.user2) return "Usuario Desconocido";
      return this.chat.user1_id === this.userId
        ? `${this.chat.user2.first_name} ${this.chat.user2.last_name}`
        : `${this.chat.user1.first_name} ${this.chat.user1.last_name}`;
    },
  },
  methods: {
    async cargarMensajes() {
      try {
        const response = await axios.get(`/chats/${this.chat.id}/mensajes`);
        this.mensajes = response.data;
        this.scrollToBottom();
      } catch (error) {
        console.error("Error cargando los mensajes:", error);
      }
    },
    async enviarMensaje() {
      if (this.nuevoMensaje.trim() === "") return;

      try {
        await axios.post(`/chats/${this.chat.id}/mensajes`, {
          mensaje: this.nuevoMensaje,
        });
        this.nuevoMensaje = "";
        // Recargar mensajes después de enviar uno nuevo
        this.cargarMensajes();
      } catch (error) {
        console.error("Error enviando el mensaje:", error);
      }
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.messagesContainer;
        container.scrollTop = container.scrollHeight;
      });
    },
    async cargarChats() {
      try {
        const response = await axios.get("/chats");
        this.chats = response.data;
      } catch (error) {
        console.error("Error cargando los chats:", error);
      }
    },
    async verificarEsCompanie() {
      try {
        const response = await axios.get("/IsCompanie");
        this.mostrarVideollamada = response.data.result;
      } catch (error) {
        console.error("Error verificando compañía:", error);
      }
    },
    hacerVideollamada() {
      window.open("https://meet.google.com/landing", "_blank");
    },
    setupPusher() {
      window.Echo.channel(`chat-${this.chat.id}`).listen(".message-sent", (data) => {
        this.mensajes.push(data.mensaje);
        this.scrollToBottom();
      });
    },
  },
  created() {
    this.cargarMensajes();
    this.cargarChats();
    this.verificarEsCompanie();
  },
};
</script>

<style scoped>
/* Tailwind classes should handle most of the styling */
</style>
