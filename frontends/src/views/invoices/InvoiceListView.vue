<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
      <!-- Header -->
      <div class="mb-12 flex items-center gap-4">
        <button 
          @click="$router.back()"
          class="p-2 hover:bg-white rounded-lg transition-colors"
        >
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <div>
          <h2 class="text-4xl font-bold text-gray-900 mb-2">Invoices</h2>
          <p class="text-gray-600">Manage and track your invoices</p>
        </div>
      </div>
    
      <!-- Loading State -->
      <div v-if="loading" class="flex justify-center items-center py-20">
        <div class="animate-spin rounded-full h-16 w-16 border-4 border-slate-200 border-t-blue-500"></div>
      </div>
    
      <!-- Invoices List -->
      <ul v-if="!loading && invoices.length > 0" class="space-y-3">
        <li v-for="invoice in invoices" :key="invoice.id" class="group">
          <router-link 
            :to="`/invoices/${invoice.id}`"
            class="block bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden border border-slate-200 hover:border-blue-300"
          >
            <div class="p-6 flex justify-between items-center">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                  <span class="text-lg font-bold text-blue-600">#{{ invoice.id }}</span>
                </div>
                <div>
                  <p class="font-semibold text-gray-900">Invoice #{{ invoice.id }}</p>
                  <p class="text-sm text-gray-500">Click to view details</p>
                </div>
              </div>
              
              <div class="flex items-center gap-8">
                <div class="text-right">
                  <p class="text-sm text-gray-600">Amount</p>
                  <p class="text-xl font-bold text-gray-900">{{ invoice.amount }}</p>
                </div>
                <span 
                  class="px-4 py-2 rounded-full text-sm font-semibold transition-all"
                  :class="invoice.status === 'paid' 
                    ? 'bg-green-100 text-green-700 group-hover:bg-green-200' 
                    : 'bg-amber-100 text-amber-700 group-hover:bg-amber-200'"
                >
                  {{ invoice.status }}
                </span>
              </div>
            </div>
          </router-link>
        </li>
      </ul>

      <!-- Empty State -->
      <div v-else-if="!loading" class="text-center py-20">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
          <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
        <p class="text-gray-600 text-lg font-medium">No invoices found</p>
        <p class="text-gray-500 text-sm mt-1">Create your first invoice to get started</p>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
  import { useInvoices } from "@/composables/useInvoices";
  import { onBeforeMount } from "vue";
  
  const { invoices, loading, fetchInvoices } = useInvoices();

  onBeforeMount( async () => {
    await fetchInvoices();
  });
</script>