<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  password: null,
  password_confirmation: null,
  current_password: null,
})

function submit() {
  console.log(form.data())
  form.post(route('user.password.change'))
}
</script>

<template>
  <form @submit.prevent="submit">
    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 sm:col-span-3">
        <label
          for="current-password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Current password</label
        >
        <input
          v-model="form.current_password"
          type="password"
          name="current-password"
          id="current-password"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="••••••••"
        />
        <span
          v-if="form.errors?.current_password"
          class="text-sm text-red-400"
          >{{ form.errors?.current_password }}</span
        >
      </div>
      <div class="col-span-6 sm:col-span-3">
        <label
          for="password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >New password</label
        >
        <input
          v-model="form.password"
          type="password"
          id="password"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="••••••••"
        />
        <span v-if="form.errors?.password" class="text-sm text-red-400">{{
          form.errors?.password
        }}</span>
      </div>
      <div class="col-span-6 sm:col-span-3">
        <label
          for="confirm-password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Confirm password</label
        >
        <input
          v-model="form.password_confirmation"
          type="password"
          name="confirm-password"
          id="confirm-password"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="••••••••"
        />
        <span
          v-if="form.errors?.password_confirmation"
          class="text-sm text-red-400"
          >{{ form.errors?.password_confirmation }}</span
        >
      </div>
      <div class="col-span-6 sm:col-full">
        <button
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="submit"
        >
          Save all
        </button>
      </div>
    </div>
  </form>
</template>
