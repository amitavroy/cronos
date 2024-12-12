<script setup>
import { ref } from 'vue'

const { topCustomers, topProducts } = defineProps({
  topCustomers: {
    type: Object,
    required: true
  },
  topProducts: {
    type: Object,
    required: true
  }
})
const hideCustomers = ref(true)
const hideProducts = ref(false)

function toggleTabVisibility() {
  hideCustomers.value = !hideCustomers.value
  hideProducts.value = !hideProducts.value
}
</script>

<template>
  <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
      Statistics this month
    </h3>

    <div class="sm:hidden">
      <label for="tabs" class="sr-only">Select tab</label>
      <select id="tabs"
              class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option>Statistics</option>
        <option>Services</option>
        <option>FAQ</option>
      </select>
    </div>
    <ul
      class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400"
      id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent">
      <li class="w-full">
        <button @click="toggleTabVisibility" type="button" :aria-selected="!hideProducts.value"
                class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">
          Top products
        </button>
      </li>
      <li class="w-full">
        <button @click="toggleTabVisibility" :aria-selected="!hideCustomers.value"
                class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">
          Top Customers
        </button>
      </li>
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
      <div :class="['pt-4', 'top-products', { hidden: hideProducts }]">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
          <li class="py-3 sm:py-4" v-for="product in topProducts" v-bind:key="product.id">
            <div class="flex items-center justify-between">
              <div class="flex items-center min-w-0">
                <img class="flex-shrink-0 w-10 h-10"
                     src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png" alt="imac" />
                <div class="ml-3">
                  <p class="font-medium text-gray-900 truncate dark:text-white">{{ product.name }}</p>
                  <div class="flex items-center justify-start flex-1 text-sm text-green-500 dark:text-green-400">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                         aria-hidden="true">
                      <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                      </path>
                    </svg>
                    2.5%
                    <span class="ml-2 text-gray-500">vs last month</span>
                  </div>
                </div>
              </div>
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                ₹{{ product.price }}
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div :class="['pt-4', 'top-customers', { hidden: hideCustomers }]">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
          <li class="py-3 sm:py-4" v-for="customer in topCustomers" v-bind:key="customer.id">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full"
                     src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil" />
              </div>
              <div class="flex-1 min-w-0">
                <p class="font-medium text-gray-900 truncate dark:text-white">
                  {{ customer.name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                  {{ customer.email }}
                </p>
              </div>
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                $3320
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
