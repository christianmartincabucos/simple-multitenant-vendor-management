import { useInvoiceStore } from "@/stores/invoiceStore";
import { ref } from "vue";

export function useInvoices() {
  const store = useInvoiceStore();
  return {
    invoices: ref(store.invoices),
    selectedInvoice: ref(store.selectedInvoice),
    loading: ref(store.loading),
    fetchInvoices: () => store.fetchInvoices(),
    fetchInvoice: (id: number) => store.fetchInvoice(id),
    createInvoice: store.createInvoice,
    updateInvoice: store.updateInvoice,
    deleteInvoice: store.deleteInvoice,
  };
}
