<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import UserForm from '../../Forms/UserForm.vue'
import Rupee from '../../Components/Rupee.vue'
import Date from '../../Components/Date.vue'

const { order } = defineProps({
  order: {
    type: Object,
    required: true,
  },
})

const breadCrumb = [
  { name: 'Orders', link: route('order.index') },
  {
    name: 'View Orders',
    link: route('order.index'),
  },
  {
    name: 'Show order',
    link: null,
  },
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="View customer" />
    </PageContainer>

    <div class="grid grid-cols-2 gap-4">
      <ContentCard> </ContentCard>

      <ContentCard> </ContentCard>
    </div>
  </div>
</template>
