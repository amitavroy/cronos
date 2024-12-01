<script setup>
import { Link } from '@inertiajs/vue3'
import Icon from './Icon.vue'

const { menuObject } = defineProps({
  menuObject: Object,
})

const dropDownId = menuObject.parent
</script>

<template>
  <li>
    <button
      type="button"
      class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
      aria-controls="dropdown-layouts"
      :data-collapse-toggle="dropDownId"
      aria-expanded="false"
    >
      <Icon :name="menuObject.iconName" />
      <span
        class="flex-1 ml-3 text-left whitespace-nowrap"
        sidebar-toggle-item
        >{{ menuObject.parent }}</span
      >
      <svg
        sidebar-toggle-item
        class="w-6 h-6"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </button>
    <ul :id="dropDownId" class="hidden py-2 space-y-2">
      <li v-for="item in menuObject.subItems">
        <Link
          :href="item.href"
          class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
        >
          {{ item.name }}
        </Link>
      </li>
    </ul>
  </li>
</template>
