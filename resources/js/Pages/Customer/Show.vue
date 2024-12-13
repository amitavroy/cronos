<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import UserForm from '../../Forms/UserForm.vue'

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

    <div class="w-1/2">
      <ContentCard>
        <UserForm
          :initial-data="customer"
          :url="route('user.update', {user: customer.id})"
          :is-create="false" />
      </ContentCard>
    </div>
  </div>
</template>
