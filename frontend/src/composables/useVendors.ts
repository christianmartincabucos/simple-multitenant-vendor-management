import { useVendorStore } from "@/stores/vendorStore";
import { computed } from "vue";

export function useVendors() {
  const store = useVendorStore();
  return {
    vendors: computed(() => store.vendors),
    loading: computed(() => store.loading),
    fetchVendors: async () => await store.fetchVendors(),
  };
}
