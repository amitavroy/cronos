<script setup>
import PageContainer from '../../Components/PageContainer.vue'
import Breadcrumb from '../../Components/Breadcrumb.vue'
import PageTitle from '../../Components/PageTitle.vue'
import ContentCard from '../../Components/ContentCard.vue'
import SegmentForm from './SegmentForm.vue'

const breadCrumb = [
  { name: 'Commerce', link: route('product.index') },
  { name: 'Segments', link: route('segment.index') },
  { name: 'Create segment', link: null }
]
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumb" />
      <PageTitle title="Create new Segment" />
    </PageContainer>

    <div class="grid">
      <ContentCard>
        <SegmentForm :url="route('segment.store')" :is-create="true" />
      </ContentCard>
    </div>
  </div>
</template>
