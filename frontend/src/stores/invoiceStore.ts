import { defineStore } from "pinia";
import { invoiceApi } from "@/api/invoices";
import type { Invoice } from "@/types";

export const useInvoiceStore = defineStore("invoice", {
  state: () => ({
    invoices: [] as Invoice[],
    selectedInvoice: null as Invoice | null,
    loading: false,
  }),

  getters: {
    getInvoices: (state) => state.invoices,
    invoiceCount: (state) => state.invoices.length,
    getInvoiceById: (state) => (id: number) =>
      state.invoices.find((i) => i.id === id) || null,
    isLoading: (state) => state.loading,
  },

  actions: {
    setInvoices(invoices: Invoice[]) {
      this.invoices = invoices;
    },
    setSelectedInvoice(invoice: Invoice | null) {
      this.selectedInvoice = invoice;
    },
    async fetchInvoices() {
      this.loading = true;
      try {
        const res = await invoiceApi.list();
        this.setInvoices(res.data);
      } finally {
        this.loading = false;
      }
    },
    async fetchInvoice(id: number) {
      this.loading = true;
      try {
        const res = await invoiceApi.show(id);
        this.setSelectedInvoice(res.data);
      } finally {
        this.loading = false;
      }
    },
    async createInvoice(payload: Partial<Invoice>) {
      this.loading = true;
      try {
        const res = await invoiceApi.create(payload);
        this.invoices.push(res.data);
      } finally {
        this.loading = false;
      }
    },
    async updateInvoice(id: number, payload: Partial<Invoice>) {
      this.loading = true;
      try {
        const res = await invoiceApi.update(id, payload);
        const idx = this.invoices.findIndex(i => i.id === id);
        if (idx !== -1) this.invoices[idx] = res.data;
        if (this.selectedInvoice?.id === id) this.selectedInvoice = res.data;
      } finally {
        this.loading = false;
      }
    },
    async deleteInvoice(id: number) {
      this.loading = true;
      try {
        await invoiceApi.delete(id);
        this.invoices = this.invoices.filter(i => i.id !== id);
        if (this.selectedInvoice?.id === id) this.selectedInvoice = null;
      } finally {
        this.loading = false;
      }
    },
  },
});