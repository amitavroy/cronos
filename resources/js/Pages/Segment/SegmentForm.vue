<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from '../../Components/InputText.vue'
import { ISegmentData } from '../../types'

const { initialData, url, isCreate } = defineProps({
  initialData: {
    type: Object as () => ISegmentData,
    default: () => ({}),
  },
  url: {
    type: String,
    required: true,
  },
  isCreate: {
    type: Boolean,
    default: true,
  },
})

const form = useForm({
  name: initialData.name || '',
  description: initialData.description || '',
})

function submit() {
  isCreate ? form.post(url) : form.patch(url)
}
</script>

<template>
  <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
    <InputText
      v-model="form.name"
      name="Segment name"
      placeholder="Enter segment name"
      :error-message="form.errors?.name"
    />
    <InputText
      v-model="form.description"
      name="Segment description"
      placeholder="Enter segment description"
      :error-message="form.errors?.description"
    />

    <button
      type="submit"
      class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
    >
      Save
    </button>
  </form>
</template>
