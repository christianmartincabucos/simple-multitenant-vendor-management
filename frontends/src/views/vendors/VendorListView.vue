<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
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
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Vendors</h2>
                <p class="text-gray-600">Manage and track your vendors</p>
                </div>
            </div>

            <div v-if="vendors.length === 0" class="text-center py-12">
                <p class="text-slate-500 text-lg">No vendors found</p>
            </div>

            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="vendor in vendors"
                    :key="vendor.id"
                    class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 p-6 border-l-4 border-blue-500 cursor-pointer group"
                >
                    <h3 class="text-lg font-semibold text-slate-900 group-hover:text-blue-600 transition-colors">
                        {{ vendor.name }}
                    </h3>
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <span class="text-sm text-slate-500">ID: {{ vendor.id }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import { useVendors } from "@/composables/useVendors";
    
    const { vendors, fetchVendors } = useVendors();
    await fetchVendors();
</script>