<script setup>
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import Icon from '../../Components/Icon.vue'
import PageContainer from '../../Components/PageContainer.vue'
import CustomerTable from './CustomerTable.vue'

const { customers } = defineProps({ customers: Object })
const breadCrumb = [
  { name: 'Commerce', link: route('product.index') },
  {
    name: 'View Customers',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <div class="mb-4">
        <Breadcrumb :links="breadCrumb" />
        <PageTitle title="All customers" />
      </div>

      <div
        class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700"
      >
        <div class="flex items-center mb-4 sm:mb-0">
          <form class="sm:pr-3" action="#" method="GET">
            <label for="products-search" class="sr-only">Search</label>
            <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
              <input
                type="text"
                name="email"
                id="products-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Search for products"
              />
            </div>
          </form>
          <div class="flex items-center w-full sm:justify-end">
            <div class="flex pl-2 space-x-1">
              <a
                href="#"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <Icon name="gear" />
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <Icon name="trash" />
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <Icon name="exclaim" />
              </a>
              <a
                href="#"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <Icon name="dots" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </PageContainer>

    <CustomerTable :customers="customers" />
  </div>
</template>
