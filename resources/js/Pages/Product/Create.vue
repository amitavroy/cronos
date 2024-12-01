<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import ProductForm from '../../Forms/ProductForm.vue'

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
      <PageTitle title="Add new Product" />
    </PageContainer>

    <div class="w-1/2">
      <ContentCard>
        <ProductForm :url="route('product.store')" />
      </ContentCard>
    </div>
  </div>
</template>
