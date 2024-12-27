<script setup>
import { router } from '@inertiajs/vue3'
import Pagination from '../../Components/Pagination.vue'

const { notifications } = defineProps({
  notifications: Object,
})

function deleteNotification(notificationId) {
  if (confirm('Sure you delete this notification?')) {
    router.delete(
      route('notification.destroy', { notification: notificationId }),
      {
        preserveScroll: true,
      },
    )
  }
}
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
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Actions
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
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 text-right"
        >
          <div class="text-base text-gray-900 dark:text-white">
            <button
              @click="deleteNotification(notification.id)"
              type="button"
              id="deleteProductButton"
              class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
            >
              <svg
                class="w-4 h-4 mr-2"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Delete item
            </button>
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
