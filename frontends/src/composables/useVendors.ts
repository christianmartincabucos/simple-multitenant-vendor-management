import { useVendorStore } from "@/stores/vendorStore";

export function useVendors() {
  const store = useVendorStore();
  return {
    vendors: store.vendors,
    fetchVendors: store.fetchVendors,
  };
}
