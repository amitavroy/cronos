<script setup>
import Pagination from '../../Components/Pagination.vue'

const { notifications } = defineProps({
  notifications: Object,
})
</script>

<template>
  <table
    class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600"
  >
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Title
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Message
        </th>
      </tr>
    </thead>
    <tbody
      class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
      v-if="notifications?.data && notifications.data.length > 0"
    >
      <tr
        class="hover:bg-gray-100 dark:hover:bg-gray-700"
        v-for="notification in notifications?.data"
        :key="notification.id"
      >
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base font-semibold text-gray-900 dark:text-white">
            {{ notification.title }}
          </div>
        </td>
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base text-gray-900 dark:text-white">
            {{ notification.message }}
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <div
    class="p-4 bg-white w-full flex justify-center"
    v-if="notifications?.links"
  >
    <Pagination :links="notifications.links" />
  </div>
</template>
