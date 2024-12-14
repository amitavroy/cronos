<script setup>
import { ref } from 'vue';
import { formatDateToBrowserTimezone } from '../utils/formatdate'

const { date } = defineProps({
  date: {
    type: String,
    required: true
  }
})

const formattedDate = ref(date)
formattedDate.value = formatDateToBrowserTimezone(date)

</script>

<template>
  <div>
    {{ formattedDate }}
  </div>
</template>
