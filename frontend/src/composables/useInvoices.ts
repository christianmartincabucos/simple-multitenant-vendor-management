import { useInvoiceStore } from "@/stores/invoiceStore";
import { computed } from "vue";

export function useInvoices() {
  const store = useInvoiceStore();
  return {
    invoices: computed(() => store.invoices),
    selectedInvoice: computed(() => store.selectedInvoice),
    loading: computed(() => store.loading),
    fetchInvoices: async () => await store.fetchInvoices(),
    fetchInvoice: (id: number) => store.fetchInvoice(id),
    createInvoice: store.createInvoice,
    updateInvoice: store.updateInvoice,
    deleteInvoice: store.deleteInvoice,
  };
}