<template>
  <span>₹{{ amount }}</span>
</template>

<script setup>
defineProps({
  amount: {
    type: Number,
    required: true,
  },
})
</script>
