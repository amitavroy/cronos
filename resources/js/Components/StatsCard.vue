<script setup>
import Icon from './Icon.vue'

const { title } = defineProps({
  title: {
    type: String,
    required: true,
  },
  stats: {
    type: String,
    required: true,
  },
  number: {
    type: String,
    required: true,
  },
  message: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    default: null,
  },
})
</script>

<template>
  <div
    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800"
  >
    <div class="w-full flex justify-between">
      <div>
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">
          {{ title }}
        </h3>
        <span
          class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"
          >{{ stats }}</span
        >
        <p
          class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400"
        >
          <span
            class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400"
          >
            <Icon name="up-arrow" />
            {{ number }}
          </span>
          {{ message }}
        </p>
      </div>
      <div v-if="icon">
        <Icon :name="icon" />
      </div>
    </div>
  </div>
</template>
