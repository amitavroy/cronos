<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import { Link } from '@inertiajs/vue3'
import NotificationTable from './NotificationTable.vue'

const { notifications } = defineProps({
  notifications: {
    type: Object,
    required: true
  }
});
const breadCrumb = [{ name: 'Notifications', link: route('user.index') }]
</script>

<template>
  <div>
    <PageContainer>
      <div class="mb-4">
        <Breadcrumb :links="breadCrumb" />
        <PageTitle title="Recent Notifications" />
      </div>

      <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
        <div class="flex items-center mb-4 sm:mb-0"></div>
        <Link :href="route('notification.create')" id="createProductButton"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          type="button">Add new notification
        </Link>
      </div>
    </PageContainer>

    <NotificationTable :notifications="notifications" />
  </div>
</template>
