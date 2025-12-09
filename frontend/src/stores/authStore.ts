import { defineStore } from "pinia";
import type { User, Organization } from "@/types";
import { authApi } from "@/api/auth"; // Make sure this import matches your project structure

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: null as string | null,
    user: null as User | null,
    organization: null as Organization | null,
  }),
  actions: {
    hydrate() {
      this.user = JSON.parse(sessionStorage.getItem("user") || "{}");
      this.organization = JSON.parse(sessionStorage.getItem("organization") || "{}");
      this.token = sessionStorage.getItem("token");
    },
    set(token: string, user: User, org: Organization) {
      this.token = token;
      this.user = user;
      this.organization = org;
      sessionStorage.setItem("token", token);
      sessionStorage.setItem("user", JSON.stringify(user));
      sessionStorage.setItem("organization", JSON.stringify(org));
    },
    clear() {
      this.token = null;
      this.user = null;
      this.organization = null;
      sessionStorage.removeItem("token");
      sessionStorage.removeItem("user");
      sessionStorage.removeItem("organization");
    },
    async login(email: string, password: string) {
      const res = await authApi.login(email, password);
      this.set(res.token, res.user, res.organization);
    },
    async logout() {
      await authApi.logout();
      this.clear();
    },
  },
});