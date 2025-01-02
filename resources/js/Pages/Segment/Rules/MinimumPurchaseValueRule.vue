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
          name="Minimum Purchase Value Rule"
          placeholder="Enter the Minimum Purchase Value Rule"
        />
        <div class="px-2 text-sm">
          <p>
            This is the minimum purchase value rule that a customer should have
            to enter this segment
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
