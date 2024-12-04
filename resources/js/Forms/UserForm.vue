<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from '../Components/InputText.vue'
import { IInitialUserData } from '../types'

const { initialData, url, isCreate } = defineProps({
  initialData: {
    type: Object as () => IInitialUserData,
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
  email: initialData.email || '',
  password: initialData.password || '',
  position: initialData.position || '',
  country: initialData.country || '',
})

function submit() {
  isCreate ? form.post(url) : form.patch(url)
}
</script>

<template>
  <form @submit.prevent="submit">
    <InputText
      v-model="form.name"
      name="User name"
      placeholder="Enter product name"
      :error-message="form.errors?.name"
    />
    <InputText
      v-model="form.email"
      name="User email"
      placeholder="Enter user email"
      :error-message="form.errors?.email"
    />
    <InputText
      v-if="isCreate"
      v-model="form.password"
      name="User password"
      placeholder="Enter user's password"
      :error-message="form.errors?.password"
    />
    <InputText
      v-model="form.position"
      name="User position"
      placeholder="Enter the position of the user"
      :error-message="form.errors?.position"
    />
    <InputText
      v-model="form.country"
      name="User country"
      placeholder="Enter the country of the user"
      :error-message="form.errors?.country"
    />

    <button
      type="submit"
      class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
    >
      Save
    </button>
  </form>
</template>
