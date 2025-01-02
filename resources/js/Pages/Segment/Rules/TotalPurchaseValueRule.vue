<script setup>
import InputText from '../../../Components/InputText.vue'

const model = defineModel()
</script>

<template>
  <div class="my-8 p-4 border rounded">
    <div class="flex align-middle">
      <div class="flex-2">
        <InputText
          v-model="model"
          name="Total Purchase Value Rule"
          placeholder="Enter the Total Purchase Value Rule"
        />
        <div class="px-2 text-sm">
          <p>
            This is the total purchase value rule that a customer should have so
            far to get into this segment
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
