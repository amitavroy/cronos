<script setup>
import PageContainer from '@/Components/PageContainer.vue'
import PageTitle from '@/Components/PageTitle.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import NotificationForm from '@/Forms/NotificationForm.vue'
import ContentCard from '@/Components/ContentCard.vue'
const breadCrumb = [
  { name: 'Notification', link: route('notification.index') },
  { name: 'Create', link: route('notification.create') },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="Add new Notification" />
    </PageContainer>

    <div class="w-1/2">
      <ContentCard>
        <NotificationForm :url="route('notification.store')" />
      </ContentCard>
    </div>
  </div>
</template>
