import { http } from "@/libs/http";
import type { Invoice } from "@/types";

export interface InvoiceFilters {
  status?: string;
  vendor_id?: number;
  per_page?: number;
}

export const invoiceApi = {
  list: (filters?: InvoiceFilters) => http.get<{ data: Invoice[]; meta?: any }>("/invoices", filters),
  show: (id: number) => http.get<{ data: Invoice }>("/invoices/" + id),
  create: (payload: Partial<Invoice>) => http.post<{ data: Invoice }>("/invoices", payload),
  update: (id: number, payload: Partial<Invoice>) => http.put<{ data: Invoice }>("/invoices/" + id, payload),
  delete: (id: number) => http.delete(`/invoices/${id}`),
};
