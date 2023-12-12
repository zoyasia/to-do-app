<template>
  <main>
    <NavBar></NavBar>
    <RouterView></RouterView>
  </main>
</template>

<script setup lang="ts">
import { RouterView } from "vue-router";
import NavBar from "./components/TheNavBar.vue";
</script>
