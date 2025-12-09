<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
      <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-12">
          <h2 class="text-4xl font-bold text-gray-900">Dashboard</h2>
          <p class="text-gray-600 mt-2">Welcome back, {{ user?.email }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-blue-600 hover:shadow-lg transition">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Organization</p>
            <p class="text-3xl font-bold text-gray-900">{{ org?.name }}</p>
          </div>
          
          <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-green-600 hover:shadow-lg transition">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">User Profile</p>
            <p class="text-lg font-semibold text-gray-900">{{ user?.email }}</p>
            <span class="inline-block mt-3 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
              {{ user?.role }}
            </span>
          </div>
        </div>

        <div class="flex gap-4 flex-wrap">
          <router-link to="/invoices" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
            📄 Invoices
          </router-link>
          <router-link to="/vendors" class="px-8 py-3 bg-gray-600 text-white rounded-xl font-semibold hover:bg-gray-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
            🏢 Vendors
          </router-link>
        </div>
      </div>
    </div>
</template>
  
<script lang="ts" setup>
  import { useAuthStore } from "@/stores/authStore";
  
  const authStore = useAuthStore();
  const org = authStore.organization;
  const user = authStore.user;
</script>