import { authApi } from "@/api/auth";
import { useAuthStore } from "@/stores/authStore";

export function useAuth() {
  const store = useAuthStore();

  async function login(email: string, password: string) {
    const res = await authApi.login(email, password);
    store.set(res.token, res.user, res.organization);
  }

  async function logout() {
    await authApi.logout();
    store.clear();
  }

  return { login, logout, user: store.user, organization: store.organization, token: store.token };
}
