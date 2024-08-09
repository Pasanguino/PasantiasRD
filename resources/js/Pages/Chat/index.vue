<template>
  <div class="container">
    <label for="user2Input">ID Usuario 2:</label>
    <input
      v-model="user2_id"
      id="user2Input"
      type="text"
      placeholder="Ingrese ID Usuario 2"
    />

    <button @click="createChat">Crear Chat</button>

    <h2>Chats Creados</h2>
    <ul>
      <li v-for="chat in chats" :key="chat.id">
        <button @click="goToChat(chat.id)">
          Chat ID: {{ chat.id }} - Usuario 1: {{ chat.user1_id }} - Usuario 2:
          {{ chat.user2_id }}
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user2_id: "",
      chats: [],
    };
  },
  methods: {
    async createChat() {
      try {
        // Enviar solicitud POST para crear un nuevo chat
        await axios.post("/chats", {
          user2_id: this.user2_id,
        });
        this.getChats(); // Recargar la lista de chats
      } catch (error) {
        console.error("Error creando el chat:", error);
      }
    },
    async getChats() {
      try {
        // Obtener la lista de chats
        const response = await axios.get("/chats");
        this.chats = response.data;
      } catch (error) {
        console.error("Error obteniendo los chats:", error);
      }
    },
    goToChat(chatId) {
      // Redirigir a la URL del chat usando window.location.href
      window.location.href = `/chat/${chatId}`;
    },
  },
  created() {
    this.getChats(); // Obtener los chats al cargar el componente
  },
};
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
button {
  background-color: #4caf50; /* Verde */
  color: white;
  padding: 10px;
  margin-top: 10px;
  border: none;
  cursor: pointer;
}
button:hover {
  background-color: #45a049; /* Verde más oscuro */
}
</style>
