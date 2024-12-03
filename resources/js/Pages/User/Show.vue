<script setup>
import Breadcrumb from '../../Components/Breadcrumb.vue'
import ProductForm from '../../Forms/ProductForm.vue'
import ContentCard from '../../Components/ContentCard.vue'
import PageContainer from '../../Components/PageContainer.vue'
import PageTitle from '../../Components/PageTitle.vue'
import UserForm from '../../Forms/UserForm.vue'

const { user } = defineProps({
  user: Object,
})

const breadCrumb = [
  { name: 'Users', link: route('user.index') },
  {
    name: 'View users',
    link: route('user.index'),
  },
  {
    name: 'Show user',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="View User" />
    </PageContainer>

    <div class="w-1/2">
      <ContentCard>
        <UserForm
          :initial-data="user"
          :url="route('user.update', { user: user.id })"
          :is-create="false"
        />
      </ContentCard>
    </div>
  </div>
</template>
