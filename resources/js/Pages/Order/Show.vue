<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import UserForm from '../../Forms/UserForm.vue'
import Rupee from '../../Components/Rupee.vue'
import Date from '../../Components/Date.vue'

const { order } = defineProps({
  order: {
    type: Object,
    required: true,
  },
})

const breadCrumb = [
  { name: 'Orders', link: route('order.index') },
  {
    name: 'View Orders',
    link: route('order.index'),
  },
  {
    name: 'Show order',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="View customer" />
    </PageContainer>

    <div class="grid grid-cols-2 gap-4">
      <ContentCard>
        <h1 class="text-4xl mb-8">Order ID: #{{ order.id }}</h1>
        <ul class="mb-12">
          <li>
            Total amount:
            <Rupee :amount="order.total_amount" />
          </li>
          <li>Status: {{ order.status }}</li>
        </ul>

        <h2 class="text-2xl">Customer details:</h2>
        <ul class="mb-8">
          <li>Name: {{ order?.user?.name }}</li>
          <li>Email: {{ order?.user?.email }}</li>
        </ul>
      </ContentCard>
      <ContentCard>
        <h2 class="text-2xl">Product details:</h2>
        <ul class="mb-8">
          <li
            class="mb-4 mt-8"
            v-for="product in order?.products"
            :key="product.id"
          >
            <strong>{{ product.name }}</strong>
            <br />
            {{ product.description }}
            <br />
            <Rupee :amount="product.price" />
          </li>
        </ul>
      </ContentCard>
    </div>
  </div>
</template>
