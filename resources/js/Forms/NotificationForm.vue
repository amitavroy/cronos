<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from '../Components/InputText.vue'
import InputCheckbox from '../Components/InputCheckbox.vue'
import { IInitialNotificationData } from '../types'
import VueSelect from 'vue3-select-component'
import { ref } from 'vue'

const selected = ref([])

const { initialData, url, isCreate, users } = defineProps({
  initialData: {
    type: Object as () => IInitialNotificationData,
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
  users: {
    type: Array,
    required: true,
  },
})

const form = useForm({
  title: initialData.title || '',
  message: initialData.message || '',
  sendToAll: true,
  users: [],
})

function submit() {
  isCreate ? form.post(url) : form.patch(url)
}
</script>

<template>
  <form @submit.prevent="submit">
    <InputText
      v-model="form.title"
      name="Notification title"
      placeholder="Enter notification title"
      :error-message="form.errors?.title"
    />
    <InputText
      v-model="form.message"
      name="Notification message"
      placeholder="Enter the message"
      :error-message="form.errors?.message"
    />
    <InputCheckbox
      v-model="form.sendToAll"
      name="sendToAll"
      text="Send to all users"
    />
    <VueSelect
      v-model="form.users"
      :is-multi="true"
      :options="users"
      label="name"
      class="mb-4"
    />

    <button
      type="submit"
      class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
    >
      Save
    </button>
  </form>
</template>
