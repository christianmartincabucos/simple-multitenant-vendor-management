import { http } from "@/libs/http";
import type { User, Organization } from "@/types";

export interface LoginResponse {
  token: string;
  user: User;
  organization: Organization;
}

export const authApi = {
  login: (email: string, password: string) => http.post<LoginResponse>("/auth/login", { email, password }),
  logout: () => http.post("/auth/logout"),
};
