<script setup>
import Icon from './Icon.vue'
import { Link } from '@inertiajs/vue3'

const { links } = defineProps({
  links: Object,
})
</script>

<template>
  <nav class="flex mb-5" aria-label="Breadcrumb">
    <ol
      class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2"
    >
      <li class="inline-flex items-center">
        <Link
          :href="route('home')"
          class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
        >
          <Icon name="home" />
          Home
        </Link>
      </li>
      <li v-for="link in links">
        <div class="flex items-center">
          <svg
            class="w-6 h-6 text-gray-400"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <Link
            v-if="link.link"
            :href="link.link"
            class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white"
          >
            {{ link.name }}
          </Link>
          <span
            v-else
            class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
            aria-current="page"
            >Products</span
          >
        </div>
      </li>
    </ol>
  </nav>
</template>
