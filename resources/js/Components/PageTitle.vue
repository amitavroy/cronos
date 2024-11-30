<script setup>
defineProps({
  title: String,
})
</script>

<template>
  <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
    {{ title }}
  </h1>
</template>
