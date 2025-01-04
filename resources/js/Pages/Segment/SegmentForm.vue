<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from '../../Components/InputText.vue'
import { ISegmentData } from '../../types'
import ContentCard from '../../Components/ContentCard.vue'
import { onMounted, reactive, ref } from 'vue'
import VueSelect from 'vue3-select-component'
import TotalPurchaseValueRule from './Rules/TotalPurchaseValueRule.vue'
import MinimumPurchaseValueRule from './Rules/MinimumPurchaseValueRule.vue'
import InputCheckbox from '../../Components/InputCheckbox.vue'

const { initialData, url, isCreate, rules } = defineProps({
  initialData: {
    type: Object as () => ISegmentData,
    default: () => ({})
  },
  url: {
    type: String,
    required: true
  },
  isCreate: {
    type: Boolean,
    default: true
  },
  rules: {
    type: Array,
    required: true
  }
})

const form = useForm({
  name: initialData.name || '',
  description: initialData.description || '',
  rules: initialData.rules || [],
  is_active: initialData.is_active
})

const rulesOptions = reactive([])
const selected = ref(null)

function submit() {
  isCreate ? form.post(url) : form.patch(url)
}

onMounted(() => {
  rules.forEach((rule) => {
    rulesOptions.push({
      label: rule.friendly_name,
      value: rule.machine_name
    })
  })
})

const addNewRuleToSegment = () => {
  if (form.rules.find((rule) => rule.rule_name === selected.value)) {
    return
  }

  if (selected.value === 'total_purchase_value') {
    form.rules.push({
      rule_name: 'total_purchase_value',
      total_purchase_value: 0
    })
  } else if (selected.value === 'minimum_purchase_value') {
    form.rules.push({
      rule_name: 'minimum_purchase_value',
      minimum_purchase_value: 0
    })
  }
}
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
        <InputCheckbox
          v-model="form.is_active"
          name="Is active"
          text="Make Segment active"
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
      <div class="block">
        <VueSelect
          v-model="selected"
          :options="rulesOptions"
          placeholder="Select a rule"
          class="mb-4"
        />
      </div>
      <div class="block">
        <button
          @click="addNewRuleToSegment"
          type="submit"
          class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
        >
          + Add rule
        </button>
      </div>
      <div class="block">
        <div v-for="(rule, key) in form.rules" :key="rule">
          <TotalPurchaseValueRule
            v-model="form.rules[key].total_purchase_value"
            v-if="rule.rule_name === 'total_purchase_value'"
          />

          <MinimumPurchaseValueRule
            v-model="form.rules[key].minimum_purchase_value"
            v-if="rule.rule_name === 'minimum_purchase_value'"
          />
        </div>
      </div>
    </ContentCard>
  </div>
</template>
