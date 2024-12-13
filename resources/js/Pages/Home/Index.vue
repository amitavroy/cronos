<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import StatsCard from '../../Components/StatsCard.vue'
import { usePage, usePoll } from '@inertiajs/vue3'
import TopProdAndCustomer from './TopProdAndCustomer.vue'

const breadCrumbs = []

const { props } = usePage()
const props_from_define = defineProps({
  random_number: String,
})
usePoll(2000)
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumbs" />
      <PageTitle title="Dashboard" />
    </PageContainer>

    <div class="px-4 pt-2">
      <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-3 2xl:grid-cols-3">
        <StatsCard title="Total products" :stats="props.product_count" number="12.5%" message="Since last month"
          icon="layout" />
        <StatsCard title="Total orders" :stats="props.order_count" number="11.5%" message="Since last month"
          icon="users" />
        <StatsCard title="Total customers" :stats="props.customer_count" number="15.5%" message="Since last month"
          icon="users" />
      </div>

      <div class="grid w-full grid-cols-2 gap-4 mt-4">
        <div>
          <TopProdAndCustomer :top-products="props.top_products" :top-customers="props.top_customers" />
        </div>
        <div>{{ props_from_define.random_number }}</div>
      </div>
    </div>
  </div>
</template>
