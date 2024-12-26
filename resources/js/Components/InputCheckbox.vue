<script setup>
const model = defineModel()
const { name, text } = defineProps({
  name: {
    type: String,
    required: true,
  },
  text: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <div class="flex items-start mb-4">
    <div class="flex items-center h-5">
      <input
        :id="name"
        :aria-describedby="name"
        :name="name"
        type="checkbox"
        v-model="model"
        class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
      />
    </div>
    <div class="ml-3 text-sm">
      <label :for="name" class="font-medium text-gray-900 dark:text-white">{{
        text
      }}</label>
    </div>
  </div>
</template>
