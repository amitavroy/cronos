<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import NotificationTable from './NotificationTable.vue'

const { notifications } = defineProps({
  notifications: {
    type: Object,
    required: true
  }
});
</script>

<template>
  <div>
    <PageContainer>
      <div class="mb-4">
        <Breadcrumb :links="breadCrumb" />
        <PageTitle title="Recent Notifications" />
      </div>
    </PageContainer>

    <NotificationTable :notifications="notifications" />
  </div>
</template>
