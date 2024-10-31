<script setup>
import Nav from "./Components/Nav.vue";
</script>

<template>
  <div class="px-5 md:px-10 lg:px-20 xl:px-32 2xl:px-52 flex-grow">
    <header class="pb-4">
      <Nav />
    </header>
    <div class="">
      <slot></slot>
    </div>
  </div>
</template>
