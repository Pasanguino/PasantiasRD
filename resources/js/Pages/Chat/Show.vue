<template>
  <div class="flex flex-col h-screen bg-gray-100">
    <!-- Header -->
    <div class="flex-none bg-blue-600 text-white p-4 text-center">
      <h1 class="text-xl font-bold">Chat with {{ chatUser }}</h1>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 p-4 overflow-y-auto bg-white">
      <div v-for="mensaje in mensajes" :key="mensaje.id" class="mb-4">
        <div
          :class="{
            'text-right': mensaje.user_id === userId,
            'text-left': mensaje.user_id !== userId,
          }"
        >
          <div
            :class="{
              'bg-blue-500 text-white': mensaje.user_id === userId,
              'bg-gray-200 text-gray-800': mensaje.user_id !== userId,
            }"
            class="inline-block px-4 py-2 rounded-lg shadow-md"
          >
            <p class="font-medium mb-1">{{ mensaje.user.name }}</p>
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
        placeholder="Write a message..."
        class="flex-1 p-2 border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2"
      />
      <button
        @click="enviarMensaje"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Send
      </button>
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
    };
  },
  computed: {
    chatUser() {
      if (!this.chat.user1 || !this.chat.user2) return "Unknown User";

      return this.chat.user1_id === this.userId
        ? this.chat.user2.name
        : this.chat.user1.name;
    },
  },
  methods: {
    async cargarMensajes() {
      try {
        const response = await axios.get(`/chats/${this.chat.id}/mensajes`);
        this.mensajes = response.data;
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
    setupPusher() {
      window.Echo.channel(`chat-${this.chat.id}`).listen(".message-sent", (data) => {
        this.mensajes.push(data.mensaje);
      });
    },
  },
  created() {
    this.cargarMensajes();
  },
};
</script>

<style scoped>
/* Tailwind classes should handle most of the styling */
</style>
