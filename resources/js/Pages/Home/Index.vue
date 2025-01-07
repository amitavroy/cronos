<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import StatsCard from '../../Components/StatsCard.vue'
import { usePoll } from '@inertiajs/vue3'
import TopProdAndCustomer from './TopProdAndCustomer.vue'
import NewOrders from '../../Components/Charts/NewOrders.vue'
import NewCustomers from '../../Components/Charts/NewCustomers.vue'

const breadCrumbs = []

const {
  order_count,
  product_count,
  customer_count,
  recent_order_count,
  top_customers,
  recent_customer_count,
  top_products,
} = defineProps({
  random_number: Number,
  order_count: Number,
  customer_count: Number,
  product_count: Number,
  recent_order_count: Object,
  top_products: Object,
  top_customers: Object,
  recent_customer_count: Object,
})
usePoll(20000)
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumbs" />
      <PageTitle title="Dashboard" />
    </PageContainer>

    <div class="px-4 pt-2">
      <div
        class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-3 2xl:grid-cols-3"
      >
        <StatsCard
          title="Total products"
          :stats="product_count"
          number="12.5%"
          message="Since last month"
          icon="layout"
        />
        <StatsCard
          title="Total orders"
          :stats="order_count"
          number="11.5%"
          message="Since last month"
          icon="users"
        />
        <StatsCard
          title="Total customers"
          :stats="customer_count"
          number="15.5%"
          message="Since last month"
          icon="users"
        />
      </div>

      <div
        class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3"
      >
        <NewOrders
          :recent-order-data="recent_order_count"
          :recent-order-count="order_count"
        />
        <NewCustomers :recent-customer-count="recent_customer_count" />
      </div>

      <div class="grid w-full grid-cols-2 gap-4 mt-4">
        <div>
          <TopProdAndCustomer
            :top-products="top_products"
            :top-customers="top_customers"
          />
        </div>
        <div></div>
      </div>
    </div>
  </div>
</template>
