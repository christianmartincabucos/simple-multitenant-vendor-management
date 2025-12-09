<script setup lang="ts">
import { ref } from 'vue'
import { RouterLink, RouterView, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const authStore = useAuthStore()
const router = useRouter()
const isLoggedIn = ref(!!sessionStorage.getItem('token'))

const logout = () => {
  authStore.clear()
  router.push('/login')
}
</script>

<template>
  <div id="app" class="min-h-screen bg-gray-50">
    <nav v-if="isLoggedIn" class="bg-white shadow-md border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-8">
            <RouterLink to="/" class="text-2xl font-bold text-gray-900">CPRAS</RouterLink>
            <div class="flex gap-8">
              <RouterLink 
                to="/" 
                class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200"
                active-class="text-blue-600 border-b-2 border-blue-600"
              >
                Dashboard
              </RouterLink>
              <RouterLink 
                to="/invoices" 
                class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200"
                active-class="text-blue-600 border-b-2 border-blue-600"
              >
                Invoices
              </RouterLink>
              <RouterLink 
                to="/vendors" 
                class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200"
                active-class="text-blue-600 border-b-2 border-blue-600"
              >
                Vendors
              </RouterLink>
            </div>
          </div>
          <button
            @click="logout"
            class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-200"
          >
            Logout
          </button>
        </div>
      </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
      <RouterView v-slot="{ Component }">
        <Suspense>
          <component :is="Component" />
          <template #fallback>
            <div class="p-6 text-center text-gray-500">
              Loading...
            </div>
          </template>
        </Suspense>
      </RouterView>
    </main>
  </div>
</template>
