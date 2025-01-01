<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from '../../Components/InputText.vue'
import { ISegmentData } from '../../types'
import ContentCard from '../../Components/ContentCard.vue'
import { onMounted, reactive } from 'vue'
import VueSelect from 'vue3-select-component'

const { initialData, url, isCreate, rules } = defineProps({
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
  rules: {
    type: Array,
    required: true,
  },
})

const form = useForm({
  name: initialData.name || '',
  description: initialData.description || '',
  rules: [],
})

const rulesOptions = reactive([])

function submit() {
  isCreate ? form.post(url) : form.patch(url)
}

onMounted(() => {
  rules.forEach((rule) => {
    rulesOptions.push({
      label: rule.friendly_name,
      value: rule.machine_name,
    })
  })
})
</script>

<template>
  <div class="grid grid-cols-2 gap-2">
    <ContentCard>
      <form @submit.prevent="submit">
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
    </ContentCard>
    <ContentCard>
      <div>
        <pre>{{ form }}</pre>
        <VueSelect
          v-model="form.rules"
          :options="rulesOptions"
          placeholder="Select a rule"
          class="mb-4"
        />
      </div>
    </ContentCard>
  </div>
</template>
