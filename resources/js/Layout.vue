<script setup>
import Nav from './Components/Nav.vue'
import Sidebar from './Components/Sidebar.vue'
import Footer from './Components/Footer.vue'
import NotificationMessage from './Components/NotificationMessage.vue'
</script>

<template>
  <div>
    <Nav />

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <Sidebar />

      <div
        id="main-content"
        class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
      >
        <main>
          <NotificationMessage
            v-if="$page.props.flash.success"
            :message="$page.props.flash.success"
          >
            {{ $page.props.flash.success }}
          </NotificationMessage>
          <slot></slot>
        </main>
        <Footer />
      </div>
    </div>
  </div>
</template>
