<script setup>
import Pagination from '../../Components/Pagination.vue'
import { Link } from '@inertiajs/vue3'
import Rupee from '../../Components/Rupee.vue';

const { customers } = defineProps({
  customers: Object
})
</script>

<template>
  <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
          Customer name
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
          Email
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
          Country
        </th>
        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
          Customer value
        </th>
      </tr>
    </thead>
    <tbody v-if="customers?.data && customers.data.length > 0"
      class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
      <tr v-for="(customer, key) in customers?.data" :key="key" class="hover:bg-gray-100 dark:hover:bg-gray-700">
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
          <div class="text-base font-semibold text-gray-900 dark:text-white">
            <Link :href="route('customer.show', { customer: customer.id })">{{ customer?.name }}</Link>
          </div>
        </td>
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
          <div class="text-base text-gray-900 font-semibold dark:text-white">
            {{ customer?.email }}
          </div>
        </td>
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
          <div class="text-base text-gray-900 dark:text-white">
            {{ customer?.country }}
          </div>
        </td>
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
          <div class="text-base text-gray-900 dark:text-white">
            <Rupee :amount="customer?.orders_sum_total_amount || 0" />
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="p-4 bg-white w-full flex justify-center">
    <Pagination :links="customers.links" />
  </div>
</template>
