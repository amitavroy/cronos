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

const { users } = defineProps({
  users: {
    type: Array,
  },
})
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="Add new Notification" />
    </PageContainer>

    <div class="grid grid-cols-2 gap-2">
      <ContentCard>
        <NotificationForm :url="route('notification.store')" :users="users" />
      </ContentCard>
    </div>
  </div>
</template>
