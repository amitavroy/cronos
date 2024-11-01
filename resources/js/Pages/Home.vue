<script setup>
import Card from "../Components/Card.vue";
import TodoAdd from "../Forms/TodoAdd.vue";
import Stat from "../Components/Stat.vue";

defineProps({
  data: Object
});
</script>

<template>
  <div class="container">
    <div class="grid grid-cols-3 gap-4 mb-4">
      <div>
        <Stat title="My Todos" :value="data?.todo_count" desc="Current Todos I am working on." />
      </div>
      <div>
        <Stat></Stat>
      </div>
      <div>
        <Stat></Stat>
      </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-4">
      <div>
        <Card width="w-full">
          <h2 class="card-title">My Todos</h2>

          <template v-slot:card-action>
            <button class="btn btn-primary">Buy Now</button>
          </template>
        </Card>
      </div>

      <div>
        <Card>
          <TodoAdd />
        </Card>
      </div>
    </div>
  </div>
</template>
