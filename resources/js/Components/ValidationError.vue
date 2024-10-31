<script setup>
defineProps({
  form: Object,
  message: String
})
</script>

<template>
  <div class="text-red-500 text-sm"
       v-show="message">
    {{ message }}
  </div>
</template>
