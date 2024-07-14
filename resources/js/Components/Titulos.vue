<template>
  <div class="text-center">
    <h1>{{ titulo }}</h1>
  </div>
</template>

<script>
export default {
  props: {
    titulo: {
      type: String,
      required: true
    }
  }
};
</script>

<style scoped>
h1 {
  font-size: 50px;
  font-weight: bold;
  color: #292929;
}
</style>