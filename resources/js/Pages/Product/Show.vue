<script setup>
import Breadcrumb from '../../Components/Breadcrumb.vue'
import ProductForm from '../../Forms/ProductForm.vue'
import ContentCard from '../../Components/ContentCard.vue'
import PageContainer from '../../Components/PageContainer.vue'
import PageTitle from '../../Components/PageTitle.vue'

const { product } = defineProps({
  product: Object,
})

const breadCrumb = [
  { name: 'Commerce', link: route('product.index') },
  {
    name: 'View Products',
    link: route('product.index'),
  },
  {
    name: 'Add Products',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="View Product" />
    </PageContainer>

    <div class="w-1/2">
      <ContentCard>
        <ProductForm
          :initial-data="product"
          :url="route('product.update', { product: product.id })"
          :is-create="false"
        />
      </ContentCard>
    </div>
  </div>
</template>
