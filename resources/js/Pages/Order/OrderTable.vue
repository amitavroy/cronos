<script setup>
import Pagination from '../../Components/Pagination.vue'

const { orders } = defineProps({
  orders: Object,
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
          Customer name
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Amount
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Product count
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Products
        </th>
      </tr>
    </thead>
    <tbody
      class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
    >
      <tr
        class="hover:bg-gray-100 dark:hover:bg-gray-700"
        v-if="orders?.data && orders.data.length > 0"
        v-for="order in orders?.data"
      >
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base font-semibold text-gray-900 dark:text-white">
            {{ order?.user?.name }}
          </div>
        </td>
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base text-gray-900 font-semibold dark:text-white">
            ₹{{ order.total_amount }}
          </div>
        </td>
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base text-gray-900 dark:text-white">
            {{ order.products_count }}
          </div>
        </td>
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="text-base text-gray-900 dark:text-white">
            <span v-for="product in order.products"
              >{{ product.name }} - ₹{{ product.price }} <br
            /></span>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="p-4 bg-white w-full flex justify-center">
    <Pagination :links="orders.links" />
  </div>
</template>
