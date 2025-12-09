import { defineStore } from "pinia";
import { vendorApi } from "@/api/vendors";
import type { Vendor } from "@/types";

export const useVendorStore = defineStore("vendor", {
  state: () => ({
    vendors: [] as Vendor[],
  }),
  actions: {
    async fetchVendors() {
      const res = await vendorApi.list();
      this.vendors = res.data;
    },
  },
});
