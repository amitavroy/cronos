<script setup>
import Card from "../Components/Card.vue";
import TodoAdd from "../Forms/TodoAdd.vue";
</script>

<template>
  <div class="container">
    <div class="flex mb-4">
      <Card width="w-1/3">
        <h2 class="card-title">Card title!</h2>
        <p>If a dog chews shoes whose shoes does he choose?</p>
        <template v-slot:card-action>
          <button class="btn btn-primary">Buy Now</button>
        </template>
      </Card>
    </div>

    <div class="flex">
      <Card>
        <TodoAdd />
      </Card>
    </div>
  </div>
</template>
