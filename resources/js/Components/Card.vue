<script setup>
  defineProps({
    width: {
      type: String,
      default: 'w-96'
    }
  })
</script>

<template>
  <div class="card bg-base-100 shadow-xl" :class="width">
    <div class="card-body">
      <slot name="default"></slot>

      <div class="card-actions justify-end">
        <slot name="card-action"></slot>
      </div>
    </div>
  </div>
</template>
