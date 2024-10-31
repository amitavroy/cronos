<script setup>
import Todo from "../../Components/Todo.vue";

defineProps({
  todos: Array
})
</script>

<template>
  <div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
      <tr>
        <th></th>
        <th>Description</th>
        <th>Completion date</th>
        <th>Status</th>
      </tr>
      </thead>

      <tbody>
      <!-- row 1 -->
      <Todo v-for="(todo, key) in todos" :key="todo.id" :todo="todo" />
      </tbody>
    </table>
  </div>
</template>
