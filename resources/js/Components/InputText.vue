<script setup>
import { computed } from 'vue'

const model = defineModel()
const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  placeholder: {
    type: String,
    default: 'Enter value...',
  },
  required: {
    type: Boolean,
    default: false,
  },
  errorMessage: {
    type: String,
    default: undefined,
  },
})
const transformedName = computed(() => {
  return props.name.toLowerCase().replace(/\s+/g, '_')
})
</script>

<template>
  <div class="mb-4">
    <label
      for="name"
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
      >{{ name }}</label
    >
    <input
      type="text"
      :name="transformedName"
      :id="transformedName"
      class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      :placeholder="props.placeholder"
      :required="required"
      v-model="model"
    />
    <span v-if="errorMessage" class="text-sm text-red-400">{{
      errorMessage
    }}</span>
  </div>
</template>
