<script setup>
import PageContainer from '../Components/PageContainer.vue'
import Breadcrumb from '../Components/Breadcrumb.vue'
import PageTitle from '../Components/PageTitle.vue'

const breadCrumbs = []
</script>

<template>
  <div>
    <PageContainer>
      <Breadcrumb :links="breadCrumbs" />
      <PageTitle title="Dashboard" />
    </PageContainer>
  </div>
</template>
