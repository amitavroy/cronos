<script setup>
import { Link } from '@inertiajs/vue3'
import ProductTable from './ProductTable.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import Icon from '../../Components/Icon.vue'
import PageContainer from '../../Components/PageContainer.vue'

const { products } = defineProps({ products: Object })
const breadCrumb = [
  { name: 'Commerce', link: route('product.index') },
  {
    name: 'View Products',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <div class="mb-4">
        <Breadcrumb :links="breadCrumb" />
        <PageTitle title="All products" />
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
        <Link
          :href="route('product.create')"
          id="createProductButton"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          type="button"
          >Add new product
        </Link>
      </div>
    </PageContainer>

    <ProductTable :products="products" />
  </div>
</template>
