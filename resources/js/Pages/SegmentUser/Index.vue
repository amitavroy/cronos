<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import UserTable from '../User/UserTable.vue'

const { users, segment } = defineProps({
  users: {
    type: Object,
    required: true
  },
  segment: {
    type: Object,
    required: true
  }
})
const breadCrumb = [{ name: 'Notifications', link: route('user.index') }]
</script>

<template>
  <div>
    <PageContainer>
      <div class="mb-4">
        <Breadcrumb :links="breadCrumb" />
        <PageTitle title="Customers in this segment" />
      </div>

      <div
        class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700"
      >
        <div class="flex items-center mb-4 sm:mb-0"></div>
      </div>
    </PageContainer>

    <UserTable :users="users" />
  </div>
</template>
