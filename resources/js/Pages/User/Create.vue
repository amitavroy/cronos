<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import UserForm from '../../Forms/UserForm.vue'

const breadCrumb = [
  { name: 'Users', link: route('user.index') },
  {
    name: 'View users',
    link: route('user.index'),
  },
  {
    name: 'Add User',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="Add new user" />
    </PageContainer>

    <div class="w-1/2">
      <ContentCard>
        <UserForm :url="route('user.store')" />
      </ContentCard>
    </div>
  </div>
</template>
