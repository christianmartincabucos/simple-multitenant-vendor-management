import { http } from "@/libs/http";
import type { Vendor } from "@/types";

export const vendorApi = {
  list: () => http.get<{ data: Vendor[] }>("/vendors"),
  show: (id: number) => http.get<{ data: Vendor }>(`/vendors/${id}`),
  create: (payload: Partial<Vendor>) => http.post<{ data: Vendor }>(`/vendors`, payload),
  update: (id: number, payload: Partial<Vendor>) => http.put<{ data: Vendor }>(`/vendors/${id}`, payload),
  delete: (id: number) => http.delete(`/vendors/${id}`),
};
