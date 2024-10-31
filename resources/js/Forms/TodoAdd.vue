<script setup>
import { router, useForm } from '@inertiajs/vue3';
import ValidationError from "../Components/ValidationError.vue";

const form = useForm({
  description: null,
  completion_date: null,
});

const formOptions = {onSuccess: () => form.reset()}
</script>

<template>
  <form @submit.prevent="form.post('/todo', formOptions)" :disabled="form.processing">

    <div class="pb-4">
      <label class="form-control w-full max-w-xs" for="description">
        <div class="label">
          <span class="label-text">Description:</span>
        </div>
        <input id="description" type="text" placeholder="Type here"
               class="input input-bordered w-full max-w-xs" v-model="form.description" />
        <ValidationError :form="form" :message="form.errors.description" />
      </label>
    </div>

    <div class="pb-4">
      <label class="form-control w-full max-w-xs" for="completion_date">
        <div class="label">
          <span class="label-text">Completion date:</span>
        </div>
        <input id="completion_date" type="date" placeholder="Type here"
               class="input input-bordered w-full max-w-xs" v-model="form.completion_date" />
        <ValidationError :form="form" :message="form.errors.completion_date" />
      </label>
    </div>

    <div class="flex justify-end">
      <button class="btn btn-neutral" type="submit">Save</button>
    </div>
  </form>
</template>
