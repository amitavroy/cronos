<script setup>
import { Link, router } from '@inertiajs/vue3'
import Pagination from '../../Components/Pagination.vue'
import Rupee from '../../Components/Rupee.vue'

const { products } = defineProps({
  products: Object,
})

function deleteProduct(productId) {
  if (confirm('Sure you delete this product?')) {
    router.delete(route('product.destroy', { product: productId }))
  }
}
</script>

<template>
  <table
    class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600"
  >
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th scope="col" class="p-4">
          <div class="flex items-center">
            <input
              id="checkbox-all"
              aria-describedby="checkbox-1"
              type="checkbox"
              class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
            />
            <label for="checkbox-all" class="sr-only">checkbox</label>
          </div>
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Product Name
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Technology
        </th>
        <th
          scope="col"
          class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400"
        >
          Description
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
          Price
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
    >
      <tr
        class="hover:bg-gray-100 dark:hover:bg-gray-700"
        v-if="products?.data && products.data.length > 0"
        v-for="product in products?.data"
      >
        <td class="w-4 p-4">
          <div class="flex items-center">
            <input
              id="checkbox-XX"
              aria-describedby="checkbox-1"
              type="checkbox"
              class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
            />
            <label for="checkbox-XX" class="sr-only">checkbox</label>
          </div>
        </td>
        <td
          class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400"
        >
          <div class="flex">
            <div class="mr-2">
              <img
                :src="product?.featured_image"
                :alt="product?.title"
                class="w-12 h-12 rounded-md"
              />
            </div>
            <div>
              <div
                class="text-base font-semibold text-gray-900 dark:text-white"
              >
                <Link :href="route('product.show', { product: product.id })"
                  >{{ product.name }}
                </Link>
              </div>
              <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                {{ product.category }}
              </div>
            </div>
          </div>
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          {{ product.category }}
        </td>
        <td
          class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400"
        >
          {{ product.description }}
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          #{{ product.id }}
        </td>
        <td
          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
          <Rupee :amount="product.price" />
        </td>

        <td class="p-4 space-x-2 whitespace-nowrap">
          <Link
            :href="route('product.show', { product: product.id })"
            id="updateProductButton"
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
            @click="deleteProduct(product.id)"
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
    <Pagination :links="products.links" />
  </div>
</template>
