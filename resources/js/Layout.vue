<script setup>
import Nav from './Components/Nav.vue'
</script>

<template>
  <main>
    <Nav />
    <section class="px-6 py-4">
      <slot></slot>
    </section>
  </main>
</template>
