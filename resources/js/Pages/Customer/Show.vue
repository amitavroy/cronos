<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import UserForm from '../../Forms/UserForm.vue'
import Rupee from '../../Components/Rupee.vue'
import Date from '../../Components/Date.vue'

const { customer } = defineProps({
  customer: {
    type: Object,
    required: true
  }
})

const breadCrumb = [
  { name: 'Users', link: route('customer.index') },
  {
    name: 'View Customers',
    link: route('customer.index')
  },
  {
    name: 'Show Customer',
    link: null
  }
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
        <UserForm :initial-data="customer" :url="route('user.update', { user: customer.id })" :is-create="false" />
      </ContentCard>

      <ContentCard>
        <h2 class="text-lg font-bold">Recent orders</h2>
        <ul>
          <li class="flex justify-between" v-for="order in customer.orders" :key="order.id">
            <div class="py-2 text-sm text-gray-500">
              <Date :date="order.created_at" />
            </div>
            <div class="p-2 text-sm text-gray-500">
              <Rupee :amount="order.total_amount" />
            </div>
          </li>
        </ul>
      </ContentCard>
    </div>
  </div>
</template>
