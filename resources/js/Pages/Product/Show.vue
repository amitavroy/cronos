<script setup>
import Breadcrumb from '../../Components/Breadcrumb.vue'
import ProductForm from '../../Forms/ProductForm.vue'
import ContentCard from '../../Components/ContentCard.vue'
import PageContainer from '../../Components/PageContainer.vue'
import PageTitle from '../../Components/PageTitle.vue'
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const { product } = defineProps({
  product: Object
})

const breadCrumb = [
  { name: 'Commerce', link: route('product.index') },
  {
    name: 'View Products',
    link: route('product.index')
  },
  {
    name: 'Add Products',
    link: null
  }
]

const fileInput = ref(null)

const productPicForm = useForm({
  featured_image: null
})

function triggerFileInput() {
  fileInput.value.click()
}

const handleFileUpload = (event) => {
  productPicForm.featured_image = event.target.files[0]
  productPicForm.submit(
    'post',
    route('product.add-feature-image', { product: product.id })
  )
}

const handleProductImageDelete = () => {
  if (confirm('Sure you delete this image?')) {
    router.delete(route('product.remove-feature-image', { product: product.id }))
  }
}
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="View Product" />
    </PageContainer>

    <div class="grid grid-cols-2 gap-2">
      <ContentCard>
        <ProductForm
          :initial-data="product"
          :url="route('product.update', { product: product.id })"
          :is-create="false"
        />
      </ContentCard>
      <ContentCard>
        <div
          class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
          <div
            class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4"
          >
            <img
              class="mb-4 rounded-lg w-40 h-40 sm:mb-0 xl:mb-4 2xl:mb-0"
              :src="product?.featured_image"
              alt="Jese"
            />
            <div>
              <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">
                Featured image
              </h3>
              <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                JPG, GIF or PNG. Max size of 800K
              </div>
              <div>
                <form class="flex items-center space-x-4">
                  <button
                    @click="triggerFileInput"
                    type="button"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    <svg
                      class="w-4 h-4 mr-2 -ml-1"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"
                      ></path>
                      <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                    </svg>
                    Upload picture
                  </button>
                  <input
                    ref="fileInput"
                    type="file"
                    class="hidden"
                    @change="handleFileUpload"
                  />
                  <button
                    @click="handleProductImageDelete"
                    type="button"
                    class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                  >
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </ContentCard>
    </div>
  </div>
</template>
