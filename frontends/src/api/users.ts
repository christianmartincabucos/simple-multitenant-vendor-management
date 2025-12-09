import { http } from "@/libs/http";
import type { User } from "@/types";

export const userApi = {
  list: () => http.get<{ data: User[] }>("/users"),
  show: (id: number) => http.get<{ data: User }>(`/users/${id}`),
  create: (payload: Partial<User>) => http.post<{ data: User }>(`/users`, payload),
  update: (id: number, payload: Partial<User>) => http.put<{ data: User }>(`/users/${id}`, payload),
  delete: (id: number) => http.delete(`/users/${id}`),
};
