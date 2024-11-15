<!-- src/App.vue -->
<template>
  <div id="app">
    <Navbar /> <!-- Si ya tienes un Navbar -->
    <Aboutme /> <!-- Aquí estamos usando el componente AboutMe -->
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'; // Importando el Navbar si ya lo tienes
import Aboutme from './components/Aboutme.vue'; // Importando el componente AboutMe

export default {
  name: 'App',
  components: {
    Navbar,
    Aboutme // Registrando el componente AboutMe
  }
}
</script>

<style>
/* Estilos globales */
</style>
