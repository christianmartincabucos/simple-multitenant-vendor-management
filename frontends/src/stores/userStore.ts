import { defineStore } from "pinia";
import { userApi } from "@/api/users";
import type { User } from "@/types";

export const useUserStore = defineStore("user", {
  state: () => ({
    users: [] as User[],
  }),
  actions: {
    async fetchUsers() {
      const res = await userApi.list();
      this.users = res.data;
    },
  },
});
