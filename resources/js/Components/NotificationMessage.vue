<script>
export default {
  props: {
    message: {
      type: String,
      required: true,
    },
    duration: {
      type: Number,
      default: 1000,
    },
  },
  data() {
    return {
      visible: false,
      timeout: null,
    }
  },
  watch: {
    message: {
      immediate: true,
      handler(newMessage) {
        if (newMessage) {
          this.showAlert()
        }
      },
    },
  },
  methods: {
    showAlert() {
      // Ensure alert is reset
      this.visible = false
      clearTimeout(this.timeout)

      // Delay slightly to allow re-triggering visibility
      setTimeout(() => {
        this.visible = true
        this.timeout = setTimeout(() => {
          this.visible = false
        }, this.duration)
      }, 10) // Small delay to reset DOM state
    },
  },
  beforeDestroy() {
    clearTimeout(this.timeout)
  },
}
</script>

<template>
  <div
    v-show="visible"
    class="fixed top-4 right-4 z-50 p-4 bg-green-300 text-green-600 rounded-md shadow-lg transition-opacity duration-500 opacity-100"
    :class="{ 'opacity-0': !visible }"
  >
    {{ message }}
  </div>
</template>

<style scoped>
.transition-opacity {
  transition: opacity 0.5s ease-in-out;
}
</style>
