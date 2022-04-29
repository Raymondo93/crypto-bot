<script setup>
import MenuComponent from "./components/MenuComponent.vue";
const helloWorldMessage = "Hello World, crypto nerds!";
</script>

<template>
  <MenuComponent />
  <main>
    <h1>{{ helloWorldMessage }}</h1>
    <h3>Hier komt een mooi kutverhaaltje dat je dit systeem moet gebruiken!</h3>
  </main>
</template>

<style lang="scss">
body {
  background-color: darkslategrey;
}
</style>
