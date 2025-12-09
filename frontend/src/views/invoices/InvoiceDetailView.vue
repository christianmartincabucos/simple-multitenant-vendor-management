<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
      <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
          <button
            @click="$router.back()"
            class="mb-4 inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"
          >
            ← Back
          </button>
          <h2 class="text-4xl font-bold text-gray-900">Invoice #{{ selectedInvoice?.id }}</h2>
          <div class="h-1 w-20 bg-blue-600 rounded mt-2"></div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="flex items-center justify-center py-12">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>

        <!-- Invoice Details -->
        <div v-else-if="selectedInvoice" class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <p class="text-white text-lg font-semibold">Invoice Details</p>
          </div>
          
          <div class="p-6 space-y-4">
            <div class="flex justify-between items-center py-3 border-b border-gray-200 hover:bg-gray-50 px-2 rounded transition">
              <span class="font-semibold text-gray-700">Amount:</span>
              <span class="text-lg font-bold text-blue-600">${{ selectedInvoice.amount }}</span>
            </div>
            
            <div class="flex justify-between items-center py-3 border-b border-gray-200 hover:bg-gray-50 px-2 rounded transition">
              <span class="font-semibold text-gray-700">Status:</span>
              <span :class="['px-3 py-1 rounded-full text-sm font-semibold', getStatusClass(selectedInvoice.status)]">
                {{ selectedInvoice.status }}
              </span>
            </div>
            
            <div class="flex justify-between items-center py-3 border-b border-gray-200 hover:bg-gray-50 px-2 rounded transition">
              <span class="font-semibold text-gray-700">Vendor ID:</span>
              <span class="text-gray-600">{{ selectedInvoice.vendor_id }}</span>
            </div>
            
            <div class="flex justify-between items-center py-3 border-b border-gray-200 hover:bg-gray-50 px-2 rounded transition">
              <span class="font-semibold text-gray-700">Created:</span>
              <span class="text-gray-600">{{ formatDate(selectedInvoice.created_at) }}</span>
            </div>
            
            <div class="flex justify-between items-center py-3 hover:bg-gray-50 px-2 rounded transition">
              <span class="font-semibold text-gray-700">Updated:</span>
              <span class="text-gray-600">{{ selectedInvoice.updated_at ? formatDate(selectedInvoice.updated_at) : "-" }}</span>
            </div>
          </div>
        </div>

        <!-- Not Found State -->
        <div v-else class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6">
          <p class="text-red-700 font-semibold text-lg">Invoice not found</p>
        </div>
      </div>
    </div>
</template>

<script lang="ts" setup>
  import { onMounted } from "vue";
  import { useRoute } from "vue-router";
  import { useInvoices } from "@/composables/useInvoices";
  
  const route = useRoute();
  const id = Number(route.params.id);
  const { selectedInvoice, loading, fetchInvoice } = useInvoices();
  
  const getStatusClass = (status: string) => {
    const classes: Record<string, string> = {
      paid: "bg-green-100 text-green-800",
      pending: "bg-yellow-100 text-yellow-800",
      overdue: "bg-red-100 text-red-800",
    };
    return classes[status] || "bg-gray-100 text-gray-800";
  };

  const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString("en-US", {
      year: "numeric",
      month: "short",
      day: "numeric",
      hour: "numeric",
      minute: "numeric",
      second: "numeric",
    });
  };
  
  await fetchInvoice(id);
</script>
