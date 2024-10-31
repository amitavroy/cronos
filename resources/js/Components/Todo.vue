<script setup>
import {computed} from 'vue';

const props = defineProps({
  todo: Object
})

const humanDate = computed(() => {
  const serverDate = props.todo?.completion_date;

  if (!serverDate) return '';

  const date = new Date(serverDate);

  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
  const year = date.getFullYear();

  return `${day}-${month}-${year}`;
})
</script>

<template>
  <tr>
    <th>{{ todo.id }}</th>
    <td>{{ todo.description }}</td>
    <td>{{ humanDate }}</td>
    <td>{{ todo.is_complete ? 'True' : 'False' }}</td>
  </tr>
</template>
