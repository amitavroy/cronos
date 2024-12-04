<script setup>
import { Link, router } from '@inertiajs/vue3'
import Pagination from '../../Components/Pagination.vue'

const { users } = defineProps({
  users: Object,
})

function deleteUser(userId) {
  if (confirm('Sure you delete this user?')) {
    router.delete(route('user.destroy', { user: userId }))
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
          Name
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Position
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Country
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          ID
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        class="hover:bg-gray-100 dark:hover:bg-gray-700"
        v-if="users?.data && users.data.length > 0"
        v-for="user in users?.data"
      >
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base font-semibold text-gray-900 dark:text-white">
            <Link :href="route('user.show', { user: user.id })"
              >{{ user.name }}
            </Link>
          </div>
          <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
            {{ user.email }}
          </div>
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          {{ user.position }}
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          {{ user.country }}
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          {{ user.id }}
        </td>
        <td class="p-4 space-x-2 whitespace-nowrap text-right">
          <Link
            :href="route('user.show', { user: user.id })"
            id="updateUserButton"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            <svg
              class="w-4 h-4 mr-2"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
              ></path>
              <path
                fill-rule="evenodd"
                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                clip-rule="evenodd"
              ></path>
            </svg>
            Update
          </Link>
          <button
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
        </td>
      </tr>
    </tbody>
  </table>

  <div class="p-4 bg-white w-full flex justify-center">
    <Pagination :links="users.links" />
  </div>
</template>
