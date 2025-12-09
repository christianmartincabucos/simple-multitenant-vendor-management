import { defineStore } from "pinia";
import { vendorApi } from "@/api/vendors";
import type { Vendor } from "@/types";

export const useVendorStore = defineStore("vendor", {
  state: () => ({
    vendors: [] as Vendor[],
    loading: false,
  }),
  actions: {
    async fetchVendors() {
      this.loading = true;
      try {
        const res = await vendorApi.list();
        this.vendors = res.data;
      } finally {
        this.loading = false;
      }
    },
  },
});
