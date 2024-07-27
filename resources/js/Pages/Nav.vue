<template>
  <nav class="nav-container">
    <ul class="nav-links">
      <li><a href="/">Home</a></li>
      <li><a href="#">Encuentra Pasantías</a></li>
      <li><a href="#">Soporte Técnico</a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'Nav'
};
</script>

<style scoped>
.nav-container {
  flex: 1;
  display: flex;
  justify-content: center; /* Centra los enlaces horizontalmente */
  position: relative;
}

.nav-links {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;  
  margin: 0 -100px;
  padding: 18px 20px;
  background-color: #BF5F07;
  margin-top: 25px; /* altura del nav, es diferente al de /home, (no quedaba bien) */
  border-radius: 50px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1;
}

.nav-links li {
  margin: 5px 10px;
}

.nav-links li a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}
</style>
